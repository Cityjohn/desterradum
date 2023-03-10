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
    startTime = new Date();
    timer.textContent = '00:00';
    interval = setInterval(() => 
    {
      time++;
      const minutes = Math.floor(time / 60);
      const seconds = time % 60;
      timer.textContent = `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
    }, 1000);


    $.ajax(
      {
      type: 'POST',
      url: './Read_file.php',
      data: {fileName: 'test.txt'},
      success: function(response) 
        {
          console.log(response);
        }
      });

  }
  
});