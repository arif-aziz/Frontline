</div>

<script type='text/javascript' src="/js/jquery-1.4.2.js"></script>
<script type="text/javascript" src="/js/jquery.js"></script>
<script type="text/javascript" src="/js/jquery.gritter/js/jquery.gritter.js"></script>
<script type="text/javascript" src="/js/jquery.select2/select2.min.js"></script>
<script type="text/javascript" src="/js/jquery.parsley/parsley.js"></script>
<script type="text/javascript" src="/js/bootstrap.slider/js/bootstrap-slider.js"></script>

<script type="text/javascript" src="/js/fuelux/loader.min.js"></script>   
  <script type="text/javascript" src="/js/modernizr.js"></script>

<script type="text/javascript" src="/js/jquery.nanoscroller/jquery.nanoscroller.js"></script>
<script type="text/javascript" src="/js/bootstrap.switch/bootstrap-switch.min.js"></script>
<script type="text/javascript" src="/js/jquery.nestable/jquery.nestable.js"></script>
<script type="text/javascript" src="/js/bootstrap.datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript" src="/js/behaviour/general.js"></script>
<script type="text/javascript" src="/js/jquery.ui/jquery-ui.js"></script>

<script type="text/javascript" src="/js/jquery.sparkline/jquery.sparkline.min.js"></script>

<script type="text/javascript" src="/js/bootstrap.jasny/js/jasny-bootstrap.min.js"></script>
<script type="text/javascript" src="/js/skycons/skycons.js"></script>
<script type="text/javascript" src="/js/jquery.niftymodals/js/jquery.modalEffects.js"></script>   
<script type="text/javascript" src="/js/bootstrap.summernote/dist/summernote.min.js"></script>
<script type="text/javascript" src="/js/bootstrap.wysihtml5/lib/js/wysihtml5-0.3.0.js"></script>
  <script type="text/javascript" src="/js/bootstrap.wysihtml5/src/bootstrap-wysihtml5.js"></script>

<script type="text/javascript" src="/js/jquery.gritter/js/jquery.gritter.js"></script>
<script type="text/javascript" src="/js/jquery.datatables/jquery.datatables.min.js"></script>
<script type="text/javascript" src="/js/jquery.datatables/bootstrap-adapter/js/datatables.js"></script>
<script type="text/javascript" src="/js/jquery.icheck/icheck.min.js"></script>

<script type='text/javascript' src='/js/jquery.fullcalendar/fullcalendar/fullcalendar.js'></script>

<script type="text/javascript" src="/js/jquery.magnific-popup/dist/jquery.magnific-popup.min.js"></script>

<script type="text/javascript">
    $("#credit_slider").slider().on("slide",function(e){
      $("#credits").html("$" + e.value);
    });
    $("#rate_slider").slider().on("slide",function(e){
      $("#rate").html(e.value + "%");
    });
</script>

<script type="text/javascript">
  $(document).ready(function() {
    
    $('#external-events div.external-event').each(function() {
        var eventObject = {
          title: $.trim($(this).text()) // use the element's text as the event title
        };
        $(this).data('eventObject', eventObject);
        $(this).draggable({
          zIndex: 999,
          revert: true,      // will cause the event to go back to its
          revertDuration: 0  //  original position after the drag
        });  
    });
    
    var date = new Date();
    var d = date.getDate();
    var m = date.getMonth();
    var y = date.getFullYear();
    
    $.ajax({
        url: '/kalenderoperasi/jsonoperasi',
        type: 'GET',
        dataType: 'json',
        success: function( data ) {
            $('#calendar-op').fullCalendar({
                header: {
                  left: 'title',
                  center: '',
                  right: 'month,agendaWeek,agendaDay, today, prev,next',
                },

                editable: false,
                
                events: [ data ],
                
                droppable: true, // this allows things to be dropped onto the calendar !!!
                
                drop: function(date, allDay) { // this function is called when something is dropped
                
                  // retrieve the dropped element's stored Event Object
                  var originalEventObject = $(this).data('eventObject');
                  
                  // we need to copy it, so that multiple events don't have a reference to the same object
                  var copiedEventObject = $.extend({}, originalEventObject);
                  
                  // assign it the date that was reported
                  copiedEventObject.start = date;
                  copiedEventObject.allDay = allDay;
                  
                  // render the event on the calendar
                  // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
                  $('#calendar-op').fullCalendar('renderEvent', copiedEventObject, true);
                  
                  // is the "remove after drop" checkbox checked?
                  if ($('#drop-remove').is(':checked')) {
                    // if so, remove the element from the "Draggable Events" list
                    $(this).remove();
                  }  
                }
            });
        },
        error: function(xhr, textStatus, errorThrown) {
            $('#calendar-op').fullCalendar({
                header: {
                  left: 'title',
                  center: '',
                  right: 'month,agendaWeek,agendaDay, today, prev,next',
                },

                editable: false,
                
                events: [],
                
                droppable: true, // this allows things to be dropped onto the calendar !!!
                
                drop: function(date, allDay) { // this function is called when something is dropped
                
                  // retrieve the dropped element's stored Event Object
                  var originalEventObject = $(this).data('eventObject');
                  
                  // we need to copy it, so that multiple events don't have a reference to the same object
                  var copiedEventObject = $.extend({}, originalEventObject);
                  
                  // assign it the date that was reported
                  copiedEventObject.start = date;
                  copiedEventObject.allDay = allDay;
                  
                  // render the event on the calendar
                  // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
                  $('#calendar-op').fullCalendar('renderEvent', copiedEventObject, true);
                  
                  // is the "remove after drop" checkbox checked?
                  if ($('#drop-remove').is(':checked')) {
                    // if so, remove the element from the "Draggable Events" list
                    $(this).remove();
                  }  
                }
            });
        }
    });

    $('.image-zoom').magnificPopup({ 
        type: 'image',
        mainClass: 'mfp-with-zoom', // this class is for CSS animation below
        zoom: {
          enabled: true, // By default it's false, so don't forget to enable it
          duration: 300, // duration of the effect, in milliseconds
          easing: 'ease-in-out', // CSS transition easing function 
          opener: function(openerElement) {
            var parent = $(openerElement);
            return parent;
          }
        }
    });
    
  });
</script>

<script type="text/javascript">
    $(document).ready(function(){
      $('#txt-riwayat-pendidikan').wysihtml5();
      $('#txt-riwayat-kerja').wysihtml5();

      $('#txt-tgram-kepada').wysihtml5();
      $('#txt-tgram-tembusan').wysihtml5();
      $('#txt-tgram-isiA').wysihtml5();
      $('#txt-tgram-isiB').wysihtml5();
      $('#txt-tgram-isiC').wysihtml5();
      $('#txt-tgram-isiD').wysihtml5();
      $('#txt-tgram-isiE').wysihtml5();

      $('#txt-sprin-pertimbangan').wysihtml5();
      $('#txt-sprin-dasar').wysihtml5();
      $('#txt-sprin-kepada').wysihtml5();
      $('#txt-sprin-untuk').wysihtml5();
      $('#txt-sprin-tembusan').wysihtml5();

      $('.md-trigger').modalEffects();

      //initialize the javascript
      App.init();
      App.wizard();
      App.dataTables();
      App.textEditor();
    });
</script>

<script type="text/javascript" src="/js/behaviour/voice-commands.js"></script>
<!-- <script type="text/javascript" src="/js/bootstrap/dist/js/bootstrap.min.js"></script> -->

<!-- MYJQUERY -->
<script type="text/javascript" src="/js/jquery.handlebars/handlebars-v2.0.0.js"></script>
<script type="text/javascript">
    Handlebars.registerHelper('ifCond', function (v1, operator, v2, options) {
        switch (operator) {
            case '==':
                return (v1 == v2) ? options.fn(this) : options.inverse(this);
            case '===':
                return (v1 === v2) ? options.fn(this) : options.inverse(this);
            case '<':
                return (v1 < v2) ? options.fn(this) : options.inverse(this);
            case '<=':
                return (v1 <= v2) ? options.fn(this) : options.inverse(this);
            case '>':
                return (v1 > v2) ? options.fn(this) : options.inverse(this);
            case '>=':
                return (v1 >= v2) ? options.fn(this) : options.inverse(this);
            case '&&':
                return (v1 && v2) ? options.fn(this) : options.inverse(this);
            case '||':
                return (v1 || v2) ? options.fn(this) : options.inverse(this);
            default:
                return options.inverse(this);
        }
    });
</script>
<script type="text/javascript" src="/js/myjquery/jquery.personel.js"></script>
<script type="text/javascript" src="/js/myjquery/jquery.selectabsen.js"></script>
<script type="text/javascript" src="/js/myjquery/jquery.operasi.js"></script>
<script type="text/javascript" src="/js/myjquery/jquery.selectwilayah.js"></script>
<!-- END OF MYJQUERY -->

</body>
</html>