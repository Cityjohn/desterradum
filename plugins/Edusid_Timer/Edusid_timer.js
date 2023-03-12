const button = document.getElementById('button');
const circle = document.getElementById('circle');
const timer = document.getElementById('timer');
const select = document.getElementById('form-field-subject');
const subject = document.getElementById('subject');
const $user_id = 105;

let time = 0;
let interval;
let starttime;
let stoptime;
let test_var = 7;

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
              alert(data);
              // alert("stoptime + 10 : " + data);
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