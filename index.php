<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Full Calendar js</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.css" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
	 <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>

<script>
	$(document).ready(function(){
		var calendar = $('#calendar');
			calendar.fullCalendar({
				editable: true,
				header: {
					left: 'prev, next, today',
					center: 'title',
					right: 'month, agendaWeek, agendaDay'
				},
				events: 'load.php',
				selectable: true,
				selectHelper: true,
				select: function(start, end, allDay){
					var title = prompt('Enter an event');
					if(title){
						var start = $.fullCalendar.formatDate(start, 'Y-MM-DD HH:mm:ss');
						var end = $.fullCalendar.formatDate(end, 'Y-MM-DD HH:mm:ss');

						$.ajax({
							url: 'insert.php',
							type: 'POST',
							data: {
								title: 		title,
								start: 		start,
								end: 		end
							},
							success: function(){
								calendar.fullCalendar('refetchEvents');
								alert('Event Added');
							}
						});
					}
				}, // on select event

				eventResize: function(event){
					var id = event.id;
					var title = event.title;
					var start = $.fullCalendar.formatDate(event.start, 'Y-MM-DD HH:mm:ss');
					var end	= $.fullCalendar.formatDate(event.end, 'Y-MM-DD HH:mm:ss');

					$.ajax({
						url: 'update.php',
						type: 'POST',
						data: {
							id: 		id,
							title: 		title,
							start: 		start,
							end: 		end
						},
						success: function(){
							calendar.fullCalendar('refetchEvents');
							alert('saved changes');
						}
					})
				}, // on resize event

				eventDrop: function(event){
					var id = event.id;
					var title = event.title;
					var start = $.fullCalendar.formatDate(event.start, 'Y-MM-DD HH:mm:ss');
					var end	= $.fullCalendar.formatDate(event.end, 'Y-MM-DD HH:mm:ss');

					$.ajax({
						url: 'update.php',
						type: 'POST',
						data: {
							id: 		id,
							title: 		title,
							start: 		start,
							end: 		end
						},
						success: function(){
							calendar.fullCalendar('refetchEvents');
							alert('saved changes');
						}
					})
				}, // on drop event

				eventClick: function(event){
					var id = event.id;
					$.ajax({
						url: 'delete.php',
						type: 'POST',
						data: { id: id },
						success: function(){
							calendar.fullCalendar('refetchEvents');
							alert('Event has removed')
						}
					})
				}

			}); // fullCalendar

	})
</script>

</head>
<body>
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-10">
				<div id="calendar"></div>
			</div>
		</div>
	</div>
</body>
</html>