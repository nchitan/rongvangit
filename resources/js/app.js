require('./bootstrap');

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();


window.Pusher = require('pusher-js');
import Echo from "laravel-echo";

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: "75275c6dc301d7c225c3",
    cluster: 'ap1',
    encrypted: true
});

var notifications = [];

const NOTIFICATION_TYPES = {
    follow: 'App\\Notifications\\UserFollowed',
    newPost: 'App\\Notifications\\NewPost'
};

$(document).ready(function() {
    // check if there's a logged in user
    if(Laravel.userId) {
        $.get('/notifications', function (data) {
       
            addNotifications(data, "#notifications");
        });

        window.Echo.private(`App.Models.User.${Laravel.userId}`)
            .notification((notification) => {
                addNotifications([notification], '#notifications');
            });


    }

});

function addNotifications(newNotifications, target) {
    notifications = _.concat(newNotifications,notifications);
    // show only last 5 notifications
    notifications.slice(0, 10);

  var check = 0
  notifications.forEach(function(element){

    if (element['read_at'] == null) {
      check += 1
    }
  });
  if(check > 0){
      $('.st-NewHeader_notificationsCount').html(check)
      $('.st-NewHeader_notificationsCount').show();
  }else{
    $('.st-NewHeader_notificationsCount').hide();
  }
    showNotifications(notifications, target);
}

function showNotifications(notifications, target) {
  
  if (notifications.length) {
        var htmlElements = notifications.map(function (notification) {
          return makeNotification(notification);
        });
        $(target + 'Menu').html(htmlElements.join(''));
        if(notifications[0]['read_at'] ==null){
          // $('.st-NewHeader_notifications').addClass('has-notifications');
          $('.st-NewHeader_notificationsCount').html(notifications.length)
          $('.st-NewHeader_notificationsCount').show();

        }else {
          $('.st-NewHeader_notificationsCount').hide();
        }
  } else {
        $(target + 'Menu').html('<li class="dropdown-header">Bạn chưa có thông báo</li>');
        $('.st-NewHeader_notifications').removeClass('has-notifications');
  }
} 
// Make a single notification string

// Make a single notification string
function makeNotification(notification) {
    //var to = routeNotification(notification);
    var notificationText = makeNotificationText(notification);

    if (notification['read_at'] == null) {
      return '<li role="link" class="notification css-hegwna"><div class="css-6su6fj">' + notificationText + '</li>';
    }else{
      return '<li role="link" class="notification css-tgtzqc"><div class="css-6su6fj">' + notificationText + '</li>';
    }
}

// get the notification route based on it's type
function routeNotification(notification) {
    var to = `?read=${notification.id}`;
    if(notification.type === NOTIFICATION_TYPES.follow) {

        to = notification.data.follower_name + to;
    } else if(notification.type === NOTIFICATION_TYPES.newPost) {
        const item = notification.data.item;
        to = notification.data.following_name+`/posts/${item}` + to;
    }
    return '/' + to;
}

function makeNotificationText(notification) {
    var text = '';
    if(notification.type === NOTIFICATION_TYPES.follow) {
        var to = "?read=".concat(notification.id);
        var temp = notification.data
        if (temp.fullname == null) temp.fullname = temp.name;
        text = '<a href="/' + temp.name + '">' + '<img class="css-qc85t4 eyfquo10" src="' 
        + temp.profile_photo_url + '" width="32" height="32" size="32" loading="lazy">' 
        + '</a>' + '</div>' + '<a href="/' + temp.name + to + '" class="css-1ovl61n">' + '<p class="css-1bz4scd">' 
        + '<span class="bold">' + temp.fullname + '</span> đã theo dõi bạn.</span></p>' + '<time datetime="' 
        + temp.created_at + '" class="css-hm64qx">' + temp.created_at + '</time></a>';
    } else if(notification.type === NOTIFICATION_TYPES.newPost) {
        var to = "?read=".concat(notification.id);

        var temp ="";
        if (notification.data.data){
          temp = notification.data.data
        }else{
          temp = notification.data
        }
        if (temp.fullname == null) temp.fullname = temp.name;
        text = '<a href="/' + temp.name + '">' + '<img class="css-qc85t4 eyfquo10" src="' 
        + temp.profile_photo_url + '" width="32" height="32" size="32" loading="lazy">' 
        + '</a>' + '</div>' + '<a href="/' + temp.name + '/posts/' 
        + temp.item + to + '" class="css-1ovl61n">' + '<p class="css-1bz4scd">' 
        + '<span class="bold">' + temp.fullname + '</span> đã đăng bài viết:<span class="bold">「' 
        + temp.title + '...」</span></p>' + '<time datetime="' 
        + temp.created_at + '" class="css-hm64qx">' + temp.created_at + '</time></a>';

       
    }

    return text;
}