var RoundRobin = (function(){
		var self;
		return new Class({
		
			templateEngin: '',
			endProcessTemplate: '', 
			runningProcesses: '',
			finishedProcesses: '',
			finishedProcessCounter: 0,
			timeCounter: '',
			timeQuantum: '',
			currentRunningProcess: '',
			
			Implements: [Options],
			
			// default options
		
			options: {
				container: 'round-robin-simulation',
				timeQuantum: 4
			},
			
			stats: {
				numberOfProcesses: '',
				avgProcessTime: 0,
				longestWaitTime: '',
			},
			
			initialize: function(options){
				self = this;
				this.setOptions(options);
	
				this.templateEngin = new MTEEngine.Markup();
				this.endProcessTemplate = this.templateEngin.fromElement($('ending-process-tmplate'));
				this.runningProcesses = $$('#running-processes .running-process');
				this.finishedProcesses = $('finished-processes');
				this.stats.numberOfProcesses = this.runningProcesses.length;
				this.timeCounter = new timeCounter();
				
				this.runningProcesses.each(function(item){
					//console.log(item);
					item.process = new process({timeQuantum: self.options.timeQuantum, contentDiv: item, trackerDiv: $('time-countdown')});
					
					item.process.addEvent('processPaused', self.processPaused); // event passed to self.processPaused is in the context of the 
																				// item.process. so 'this' in self.processPaused will 
																				// be the item.process itself.
																				// use self for closure to referrence the round robin.
					item.process.addEvent('processCompleted', self.processCompleted);
					
				});
				
			},
			
			debug: function(){
				console.log(this.templateEngin);
				console.log(this.endProcessTemplate);
				console.log(this.runningProcesses);
				console.log(this.finishedProcesses);
			}, 
			
			run: function(){
				this.timeCounter.start();
				this.resume();
				return this;
			},
			resume: function(){
				if(this.runningProcesses.length!=0){
					// run process
					console.log('running current process');
					this.currentRunningProcess = this.runningProcesses.shift();
					if(this.currentRunningProcess.process.currentState == "initialized"){		
						console.log('process started');
						console.log(this.timeCounter.getCurrentTime());
						this.currentRunningProcess.process.startTime = this.timeCounter.getCurrentTime();
						this.currentRunningProcess.process.start();
					}else if(this.currentRunningProcess.process.currentState == "paused"){
						console.log('process resumed');
						this.currentRunningProcess.process.resume();
					}else{
						console.log('the current process that you are trying to run is already finished');
					}

				} else{
					self.timeCounter.pause();
					
					$('average-processing-time').innerHTML = self.stats.avgProcessTime;
					$('longest-wait-time').innerHTML = self.stats.longestWaitTime;
					console.log('all processes are finished');
				}
			},
		
			pause: function(){
				self.timeCounter.pause();
				return this;
			},
			
			processPaused: function(process){
				//console.log('here at rr process paused heard');
				//console.log(this.runningProcesses);
				//console.log(this);
				self.runningProcesses.push(self.currentRunningProcess);
				self.resume();
				
			},
			
			processCompleted: function(process){
				console.log('here at rr process completed heard');
				//$Rialto.fx.fadeOut(self.currentRunningProcess);
				
				process.finishTime = self.timeCounter.getCurrentTime();
				process.contentDiv.getElements('.title-box-content').adopt(process.constructFinishTpl());
								
				self.finishedProcesses.adopt(self.currentRunningProcess);
				self.finishedProcessCounter +=1;
				self.updateStats(process);
				
				self.resume();
			},
			
			updateStats: function(process){
				totalTimeUsed = Math.round((process.finishTime-process.startTime)*10)/10;
				waitTime = Math.round((process.finishTime-process.startTime-process.processTime)*10)/10;
				
				self.stats.avgProcessTime = (self.stats.avgProcessTime*(self.finishedProcessCounter-1)+totalTimeUsed)/self.finishedProcessCounter
				console.log(self.stats.avgProcessTime);
				if(self.stats.longestWaitTime < waitTime) self.stats.longestWaitTime = waitTime;
				console.log(self.stats.longestWaitTime);
				//if(self.stats.longestWaitTime)
			}
		
		});		
	
	
})();



var timeCounter = (function(){
	
	var tick = function(){
			this.time += 0.1;
			this.time = Math.round(this.time*10)/10;
			this.updateContentDiv();
			this.resume.delay(100, this);
	}
	
	return new Class({
		
		running: '',
		
		Implements: [Options],
		
		options: {
			time: 0,
			contentDiv: 'time-count',
		},
		
		
		initialize: function(options){
			this.setOptions(options);

			this.time = 0;
			this.contentDiv = $(this.options.contentDiv);
			//console.log('here at timecounter initialized');
			this.running = false;
		}, 
		
		start: function(){
			console.log('here at timecounter started');
			this.running = true;
			this.resume();
		},
		
		pause: function(){
			this.running = false;
		},
		
		resume: function(){
			if(this.running == true){
				tick.call(this);
			}
		},
		
		reset: function(){
			this.running = false;
			this.time = 0;
			this.updateContentDiv();
			return;
		},
		
		getCurrentTime: function(){
			return this.time;
		},
		
		updateContentDiv: function(){
			this.contentDiv.innerHTML = this.time;
			
		}
		
	});

	
})(); 
	
	
	
var process = (function(){
	
	var downTick = function(){
		this.remainingTime -= 0.1;
		this.remainingTime = Math.round(this.remainingTime*10)/10;
		this.quantumTick += 0.1;
		this.quantumTick = Math.round(this.quantumTick*10)/10;
		this.updateContentDiv();
		
		if((this.quantumTick <= this.timeQuantum && this.remainingTime ==0) || this.remainingTime <=0){
			this.running = false;
			this.complete.delay(100, this);
		}else if((this.quantumTick == this.timeQuantum) && this.remainingTime > 0){
			this.running = false;
			this.pause.delay(100, this);
		}else{
			this.resume.delay(100, this);			
		}
		
	};
	
	return new Class({
		processTime: '',
		remainingTime: '',
		timeQuantum: '',
		running: '',
		quantumTick: '',
		completed: '',
		timeCounter: '',
		currentState: '',
		startTime: '',
		finishTime: '',
		
		Implements: [Options, Events],
		
		options: {
			timeQuantum: 4,
			contentDiv: '',
			trackerDiv: '',
			timeCounter: '',
		},
		
		initialize: function(options){
			this.setOptions(options);
			this.timeQuantum = this.options.timeQuantum;
			this.quantumTick = 0;
			this.contentDiv = this.options.contentDiv;
			this.trackerDiv = this.options.trackerDiv;
			this.processTime = this.contentDiv.getElement('span.process_time').get('text');
			this.remainingTime = this.processTime;
			this.running = false;
			this.completed = false;
			this.timeCounter = this.options.timeCounter;
			this.currentState = 'initialized';

		},
		
		start: function(){
			if(this.remainingTime > 0){
				
				this.contentDiv.addClass('active');
				this.running = true;
				this.resume();				
			}else{
				console.log('this process is already finished');
			}
		},
		
		pause: function(){
			this.currentState = 'paused';
			console.log('current process paused');
			this.quantumTick = 0; // reset quantum tick;
			this.running = false;
			this.contentDiv.removeClass('active');
			this.fireEvent('processPaused', this);
			console.log('event fired');
			//fire event paused.
		},
		
		resume: function(){
			if(this.quantumTick <= this.timeQuantum && !this.completed){
				this.running = true;
				this.contentDiv.addClass('active');
				console.log(this.quantumTick);
				console.log(this.remainingTime);
				downTick.call(this);
			}else{
				console.log('this process is already complted');
			}
		},
		
		complete: function(){
			this.currentState = 'completed';
			this.quantumTick = 0;
			this.running = false;
			this.completed = true;
			this.contentDiv.removeClass('active');
			console.log('current process completed');
			this.fireEvent('processCompleted', this);
			//fire event completed.
		},
		
		updateContentDiv: function(){
			//console.log('here at update Content Div');	
			this.trackerDiv.innerHTML = this.quantumTick;
			//console.log(this.trackerDiv);
			//console.log(this.contentDiv);
			this.contentDiv.getElements('.time-left')[0].innerHTML = this.remainingTime;
		},
		
		getState: function(){
			console.log('current quantum tick:' + this.quantumTick);
			console.log('process time left :'+this.remainingTime);
		},
		
		constructFinishTpl: function(){
			$string =  '<div>Time started: '+this.startTime+' sec<br/>'
			          +'Time finsihed: '+this.finishTime+' sec</div>	';
			return Elements.from($string);
		}
	
	});
})();
	
/*
var Process = new Class({
		id: '',
		process_time: '', 
		time_left: '',
		starting_time: '',
		ending_time: '',
		
		Implements: [Options],
		
		initialize: function(options){
			
		}, 
		
	});
*/