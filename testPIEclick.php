<?php
    ini_set('display_errors',1);
    ini_set('display_startup_errors',1);
    error_reporting(-1);

    // this could be used to create different genres, and also
    // each segment of the doughnut chart will return a particular label
    // whic could be used to populate an element with the label,
    // then fill it into the PHP function on call and hopefully return the JSON form of the label
    // also make a textarea that will contain the json
    // this will probably be 2-3 days tops

    // 1. click label, 
    // take label create form, ajax, 
    // call function
    // return json in AJAX
    // put into textarea, just update the textarea
?>

<html>
    <head>
        <script type="text/javascript" src="http://code.jquery.com/jquery-2.0.2.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.min.js"></script>
        
    </head>
    <body>
        <div style="width: 1000px; height: 1000px">
          <canvas id="myChart"></canvas>
          <br>
          <textarea id="netCap" style="width: 1000px; height: 400px"></textarea>
          <!-- create a form with hidden inputs -->
          <form id="genreForm" method="post" class="labelForm" action="funCall.php">
              <input type="hidden" id ="inputGenre" value="" name="label">
          </form>
        </div>
    </body>
    <script>
        var data = {
          datasets: [{
            data: [300, 50, 100],
            backgroundColor: [
              "#F7464A",
              "#46BFBD",
              "#FDB45C"
            ]
          }],
          labels: [
            "Slip_Jig",
            "Reel",
            "Jig"
          ]
        };

        $(document).ready(
          function() {
            var canvas = document.getElementById("myChart");
            var ctx = canvas.getContext("2d");
            var myNewChart = new Chart(ctx, {
              type: 'doughnut',
              data: data
            });

            canvas.onclick = function(evt) {
              // start of the onclick function

              // preventDefault
              evt.preventDefault();

              var activePoints = myNewChart.getElementsAtEvent(evt);
              if (activePoints[0]) {
                var chartData = activePoints[0]['_chart'].config.data;
                var idx = activePoints[0]['_index'];

                // label will be a key part in this post-jquery
                var label = chartData.labels[idx];
                var value = chartData.datasets[0].data[idx];

                var url = "http://example.com/?label=" + label + "&value=" + value;

                // first create a form using jquery
                // var form = $('.labelForm');

                // now we will go onto filling the form with the value of the label 
                // populate the input with the label
                var g = $('#inputGenre').val(label);
                var same = $('input[name="label"]').val();

                // now have to submit the form with the input on it and send it off
                // post-jquery / AJAX
                // $.ajax = ({
                //             type: "POST",
                //             url: 'funCall.php',
                //             data: $('.labelForm').serialize(),
                //             dataType: "json",
                //             success: function(data){
                //                 alert('success!');
                //             },
                //             error: function(jqXHR, textStatus, errorThrown)
                //             {
                //                 alert("There was an error submitting your details");
                //                 //if fails    
                //             }
                // });

                var $form = $('.labelForm'),
                           formURL = $form.attr( "action" );
                           postData = $form.serialize();
                
                           var result = $.ajax({
                               data: postData,
                               type: 'POST',
                               url : formURL,
                               global: false,
                               async:false,
                           success:function(data, textStatus, jqXHR)
                           {
                              alert('success!');
                              // alert(data);
                              $('#netCap').val(data);
                           },
                           error: function(jqXHR, textStatus, errorThrown)
                           {
                               alert("There was an error submitting your details");//if fails    
                           }
                           }).responseText;

                console.log(same);
                // alert(url);
              }
              // end of onclick function
            };
          });

    </script>
</html>