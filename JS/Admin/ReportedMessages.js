$(document).ready(function() {
    $(".supprimer").click(function() {
        var message_id = $(this).data('message-id');
        var formData = new FormData();
        formData.append('message_id', message_id);
        fetch('./BackEnd/SupprimerMessage.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                alert(data.error);
                window.location.reload(false)
            } else {
                window.location.reload(false)
            }
        });
    });
    $(".ignore").click(function() {
        var message_id = $(this).data('message-id');
        var formData = new FormData();
        formData.append('message_id', message_id);
        fetch('./BackEnd/IgnorerMessage.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                alert(data.error);
                window.location.reload(false)
            } else {
                window.location.reload(false)
            }
        });
    });
    $(".ban").click(function() {
        var sender = $(this).data('username');
        var formData = new FormData();
        formData.append('username', sender);
        fetch('./BackEnd/ModificationBan.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                alert(data.error);
                window.location.reload(false)
            } else {
                alert(data.success);
                window.location.reload(false)
            }
        });
    });
});