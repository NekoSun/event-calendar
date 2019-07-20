
document.addEventListener('DOMContentLoaded', function() {
  var initialLocaleCode = 'ru';
  var calendarEl = document.getElementById('calendar');

  var calendar = new FullCalendar.Calendar(calendarEl, {
    // plugins: [ 'dayGrid' ],
    plugins: [ 'interaction', 'dayGrid'],
    selectable: true,
    header: {
      left: 'prev,next',
      center: '',
      right: 'title'
    },
    locale: initialLocaleCode,
    dateClick: function(info) {
      jQuery(document).ready( function($){
        $.each(nekoObj, function(){
          if (this.start === info.dateStr) {
            $('#modal').dialog({ title: 'События' + ' ' + info.dateStr, width: 630, modal: true });
          }
        });

        let title = [];

        function parseDate(input,flag) {
          switch(flag){
          case "P_DATE":
            st = input.split(/(\d+)\-(\d+)\-(\d+)/);
            output=st[3]+'.'+st[2]+'.'+st[1];
            return output;
          case "P_DATETIME":
            st = input.split(/(\d+)\-(\d+)\-(\d+)\ (\d+)\:(\d+)\:(\d+)/);
            output=st[3]+'.'+st[2]+'.'+st[1]+' '+st[4]+':'+st[5];
            return output;
          default:
            return "01.01.2000 00:00";
          }
        }

        nekoObj.forEach(function(item, i, arr) {
          if (item.start === info.dateStr){
          title.push('<li>' + parseDate(item.start, 'P_DATE') + ' ' + item.title + ' ' + item.city + ', ' + item.country + '</li>');
          // console.log(item.title);
          }
        });

        $('.ui-dialog-content').html('<ul>' + title.join('') + '</ul>');
      });
    },
    events: nekoObj
  });

  calendar.render();
});
