function deleteMessage(messageId) {
    console.log(messageId);
    if (confirm("Êtes-vous sûr de vouloir supprimer ce message ?")) {
        $.ajax({
            url: 'delete_message.php',
            type: 'POST',
            data: { messageId: messageId },
            success: function(response) {
                location.reload();
            },
            error: function(xhr, status, error) {
                alert("Une erreur s'est produite lors de la suppression du message.");
            }
        });
    }
}
function reportMessage(messageId) {
    console.log(messageId);
    $.ajax({
        url: 'report_message.php',
        type: 'POST',
        data: { messageId: messageId },
        success: function(response) {
            alert("Le message a été signalé avec succès.");
        },
        error: function(xhr, status, error) {
            alert("Une erreur s'est produite lors du signalement du message.");
        }
    });
}
function showButtons() {
    $(this).find('.action-buttons').show();
}
function hideButtons() {
    $(this).find('.action-buttons').hide();
}
document.addEventListener("DOMContentLoaded", function() {
    var messagesContainer = document.querySelector('.messages');
    if (messagesContainer) {
        messagesContainer.scrollTop = messagesContainer.scrollHeight;
    }
});