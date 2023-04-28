const button = document.getElementById('button');
const circle = document.getElementById('circle');
const timer = document.getElementById('timer');
const select = document.getElementById('form-field-subject');
const subject = document.getElementById('subject');
const topmessage = document.getElementById('topmessage');
const bottommessage  = document.getElementById('bottommessage');
const $user_id = 105;

let time = 0;
let interval;
let starttime;
let stoptime;
let timer_state = 'stopped';
let new_state = 'stopped';
let one_time_bool = true;

// Start state for the UI of the timer circle
function start_state_timer(state_new, state_timer)
{
  if (true)//new_state === state_new && timer_state === state_timer)  
  {
    circle.style.r = '30%';  
    topmessage.style.opacity = '0';
    bottommessage.style.opacity = '0';
    timer.textContent = 'start';
    timer_state = new_state;
  }
}

// function to make aa 4 digit timer run up inside the circle when the former state was 
//'start' and the new state is 'counting'
function counting_state_timer(state_new, state_timer)
{
  if (new_state === state_new && timer_state === state_timer)
  {
    timer_state = new_state; 
    circle.style.r = '30%';
    topmessage.style.opacity = '0';
    bottommessage.style.opacity = '0';
    timer.textContent = '00:00';  
    starttime = new Date();

    clearInterval(interval);
    interval = null;
    time = 0;    
    stoptime = new Date();
    
    interval =  setInterval(() => 
      {
        if (new_state === 'counting' && timer_state === 'counting')
        {
          console.log('interval = ' + interval);
          time++;
          const minutes = Math.floor(time / 60);
          const seconds = time % 60;
          timer.textContent = `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
        }  
      }, 1000);
    
  }
}

function growing_state_timer(state_new, state_timer) 
{
  if (new_state === state_new && timer_state === state_timer) 
  {
    timer.textContent = '5.5';
    topmessage.style.opacity = '1';
    bottommessage.style.opacity = '1'; 
    button.disabled = true;    // disable click actions while the circle is growing

    // define the animation properties
    const duration = 1000; // animation duration in milliseconds
    const startRadius = 30; // initial radius in percent
    const endRadius = 50; // final radius in percent
    const startTime = performance.now(); // animation start time

    // animation function
    function animate(currentTime) {
      const elapsed = currentTime - startTime; // elapsed time since the animation started
      const progress = Math.min(elapsed / duration, 1); // animation progress from 0 to 1
      const easedProgress = 1 - Math.pow(1 - progress, 3); // cubic easing function
      const currentRadius = startRadius + (endRadius - startRadius) * easedProgress; // current radius in percent
      circle.style.r = `${currentRadius}%`;

      if (progress < 1) {
        // continue the animation if it's not finished yet
        requestAnimationFrame(animate);
      } else {
        // animation finished, enable click actions after a delay of 2 seconds
        setTimeout(() => {
          button.disabled = false;
        }, 2000);
      }
    }

    // start the animation
    requestAnimationFrame(animate);

    timer_state = new_state;
  }
}

// function to make the 4 digit timer stop if the new state is 'stopped' and the former state was 'counting'
// ,to send the data to the database and reset the timer to the start state
function stop_state_timer()
{
  if (new_state === state_new && timer_state === state_timer) 
  {
    timer_state = new_state;
    circle.style.r = '50%';  
    timer.textContent = '5.5';
    topmessage.style.opacity = '1';
    bottommessage.style.opacity = '1';    

    jQuery(document).ready(function($)
    {
        $.ajax(
        { 
		  type: "POST",
          url: '/wp-admin/admin-ajax.php',
		  datatype: "json",
          data:
            {
              action: 'my_ajax_function',
              starttime: starttime.toISOString().slice(0, 19).replace('T', ' '),
              stoptime: stoptime.toISOString().slice(0, 19).replace('T', ' '),
              subject: subject.value              
            },
			
          success: function(data) 
            {
              stop_state_timer();   

            }
        });
    });

    clearInterval(interval);
    interval = null;
    time = 0;    
    stoptime = new Date();
    // console.log($user_id, subject, starttime, stoptime);

    shrinking_state_timer(state_new = 'shrinking', state_timer = 'stopped');
  }  
}

function shrinking_state_timer(state_new, state_timer)
{ 
    timer.textContent = 'start';  
    topmessage.style.opacity = '0';
    bottommessage.style.opacity = '0';

    // disable click actions while the circle is growing
    button.disabled = true;

    // define the animation properties
    const duration = 1000; // animation duration in milliseconds
    const startRadius = 50; // initial radius in percent
    const endRadius = 30; // final radius in percent
    const startTime = performance.now(); // animation start time

    // animation function
    function animate(currentTime) {
      const elapsed = currentTime - startTime; // elapsed time since the animation started
      const progress = Math.min(elapsed / duration, 1); // animation progress from 0 to 1
      const easedProgress = 1 - Math.pow(1 - progress, 3); // cubic easing function
      const currentRadius = startRadius + (endRadius - startRadius) * easedProgress; // current radius in percent
      circle.style.r = `${currentRadius}%`;

      if (progress < 1) {
        // continue the animation if it's not finished yet
        requestAnimationFrame(animate);
      } else {
        // animation finished, enable click actions after a delay of 2 seconds
        setTimeout(() => {
          button.disabled = false;
        }, 2000);
      }
    }
    requestAnimationFrame(animate);// start the animation 
}

// function to make sure the user selects a subject before starting the timer
function no_subject_selected()
{
  if (subject.value === "Select") 
  {
     alert('Please select a subject');    
  }
}

// click function to switch between the states of the timer
button.addEventListener('click', () => {
  if (subject.value == "Select"){ no_subject_selected(); return;}
  if(new_state === "counting"){new_state = "growing";}
  else if(new_state === "growing"){new_state = "stopped";}
  else if(new_state === "stopped"){new_state = "counting";}  

  counting_state_timer(state_new = 'counting', state_timer = 'stopped');
  growing_state_timer(state_new = 'growing', state_timer = 'counting');
  stop_state_timer(state_new = 'stopped', state_timer = 'growing');
});
