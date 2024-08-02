import './bootstrap';

document.addEventListener('DOMContentLoaded', function () {
    const notificationButton = document.getElementById('notificationButton');
    const notificationList = document.getElementById('notificationList');
    const notificationCountBadge = document.getElementById('notificationCount');

    let notifications = JSON.parse(localStorage.getItem('notifications')) || [];
    let notificationCount = notifications.length;
    notificationCountBadge.textContent = notificationCount;

    if (notifications.length > 0) {
        notificationList.innerHTML = '';
        notifications.forEach(notification => {
            const notificationItem = document.createElement('a');
            notificationItem.className = 'dropdown-item';
            notificationItem.href = `/posts/${notification.id}`;
            notificationItem.textContent = notification.message;
            notificationList.prepend(notificationItem);
        });
    }

    Echo.channel('posts')
        .listen('PostCreated', (e) => {
            const notificationMessage = `A new post titled "${e.post.title}" was created by ${e.post.author.name}`;
            const notificationItem = document.createElement('a');
            notificationItem.className = 'dropdown-item';
            notificationItem.href = `/posts/${e.post.id}`;
            notificationItem.textContent = notificationMessage;
            notificationList.prepend(notificationItem);

            notifications.push({ id: e.post.id, message: notificationMessage });
            localStorage.setItem('notifications', JSON.stringify(notifications));

            notificationCount++;
            notificationCountBadge.textContent = notificationCount;

            const noNotificationsMessage = notificationList.querySelector('.dropdown-item-text');
            if (noNotificationsMessage) {
                noNotificationsMessage.remove();
            }
        });

    notificationButton.addEventListener('click', () => {
        notificationCount = 0;
        notificationCountBadge.textContent = notificationCount;
        notifications = [];
        localStorage.removeItem('notifications');
    });
});
