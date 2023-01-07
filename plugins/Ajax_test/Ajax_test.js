const button = document.getElementById('button');
const circle = document.getElementById('circle');
const timer = document.getElementById('timer');
const select = document.getElementById('form-field-subject');
const subject = document.getElementById('subject');
const $user_id = 0;

let time = 0;
let interval;
let startTime;
let stopTime;

button.addEventListener('click', () => {
  if(subject.value === "Select"){return;}
  if (interval) 
  {
    clearInterval(interval);
    interval = null;
    time = 0;
    timer.textContent = 'start';
    stopTime = new Date();
    console.log($user_id, subject, startTime, stopTime);
  } 
  else 
  {
    // call ajax function
    

    jQuery(document).ready(function($) {
        $.ajax({
          url: '/wp-admin/admin-ajax.php',
          data: {
            action: 'my_ajax_function',
            param: 'my_param'
          },
          success: function(response) {
            console.log("\n\n\n\n\n\nsuccess\n\n\n\n\n\n");
            console.log(response);
          }
        });
      });
    // jQuery.ajax({
    //     type: "POST",
    //     url: "/wp-admin/admin-ajax.php",
    //     data: {
    //         action: "my_ajax_function",
    //         user_id: $user_id,
    //         subject: subject,
    //         startTime: startTime,
    //         stopTime: stopTime
    //     },
    //     success: function(data) {
    //         console.log("\n\n\n\n\n\nsuccess\n\n\n\n\n\n");
    //     }
    // });

    startTime = new Date();
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