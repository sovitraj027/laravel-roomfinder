
https://medium.com/swlh/10-laravel-helpers-that-you-should-know-9edbb78c2b0a

maps and application section

applicant and room will have many to many relationship

use detach in Many to many rel

////// ROOMCONTROLLER @destroy ->  $room->applicants()->detach(); check if working properly


Pusher.logToConsole = true;
//used old account for pusher
var pusher = new Pusher('8085e3ccd0091b7fe4a0', {
cluster: 'ap2',
forceTLS: true
});
var channel = pusher.subscribe('my-channel');
channel.bind('my-event', function (data) {
//alert(JSON.stringify(data));
if (sender_id == data.from) {
$('#' + data.to).click();
} else if (sender_id == data.to) {
if (receiver_id == data.from) {
// if receiver is selected, reload the selected user ...
$('#' + data.from).click();
} else {
var pending = parseInt($('#' + data.from).find('.pending').html());

if (pending) {
$('#' + data.from).find('.pending').html(pending + 1);
} else {
$('#'.data.from).append('<span class="pending">1</span>');
}
}
}
});

public function reject($user_id, $room_id)
{
    $applicant = Applicant::where('user_id', $user_id)->where('room_id', $room_id)->first();
    $applicant->status = 'rejected';
    $applicant->save();
    return redirect()->route('seeker_room');
}
<h2>asdasda</h2>





