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
let timer_state = 'start';
let new_state = 'start';

function start_state_timer()
{
  if (new_state === 'start' && timer_state === 'stopped') 
  {
    circle.style.r = '30%';  
    topmessage.style.opacity = '0';
    bottommessage.style.opacity = '0';
    timer.textContent = 'start';
    timer_state = 'start';
  }
}

function counting_state_timer()
{
  if (new_state === 'counting' && timer_state === 'start')
  {
    timer_state = 'counting';
    circle.style.r = '30%';
    topmessage.style.opacity = '0';
    bottommessage.style.opacity = '0';
    timer.textContent = '00:00';  
    starttime = new Date();
    interval = setInterval(() => 
      {
        time++;
        const minutes = Math.floor(time / 60);
        const seconds = time % 60;
        timer.textContent = `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
      }, 1000);
  }
}

function stop_state_timer()
{
  if (new_state === 'stopped' && timer_state === 'counting') 
  {
    timer_state = 'stopped';
    circle.style.r = '50%';  
    topmessage.style.text = 'hoera';
    bottommessage.style.text = 'hoera maar op een andere regel';
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
              stop_state_timer()
              button.addEventListener('click', () => {start_state_timer();});
              // alert(data);
            }
        });
    });

    clearInterval(interval);
    interval = null;
    time = 0;    
    stoptime = new Date();
    console.log($user_id, subject, starttime, stoptime);
  }
}

function no_subject_selected()
{
  if (subject.value === "Select") 
  {
    // alert('Please select a subject');
    alert("new_state: " + new_state + " timer_state: " + timer_state);
  }
}


button.addEventListener('click', () => {
  // if (subject.value == "Select"){ no_subject_selected(); return;}
  if(new_state === "start"){new_state = "counting";}
  else if(new_state === "counting"){new_state = "stopped";}
  else if(new_state === "stopped"){new_state = 'start';}
  
  // alert("new_state: " + new_state + " timer_state: " + timer_state);  
  start_state_timer();
  counting_state_timer();
  stop_state_timer();
  

});




/*
button.addEventListener('click', () => {
  if(subject.value === "Select"){return;}
  if (interval) 
  {
    
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
              stop_state_timer()
              button.addEventListener('click', () => {start_state_timer();});
              // alert(data);
            }
        });
    });

    clearInterval(interval);
    interval = null;
    time = 0;
    timer.textContent = 'start';
    stoptime = new Date();
    console.log($user_id, subject, starttime, stoptime);
  } 
  else 
  {
    starttime = new Date();
    timer.textContent = '00:00';
    interval = setInterval(() => 
    {
      time++;
      const minutes = Math.floor(time / 60);
      const seconds = time % 60;
      timer.textContent = `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
    }, 1000);

  }
});

*/