/**
 * DataMaq Communication Bridge
 * 
 * Abstrae el proveedor de chat para que la UI no dependa de Chatwoot o Botman.
 */
window.DataMaq = window.DataMaq || {};
window.DataMaq.Chat = {
    toggle: function() {
        if (window.$chatwoot) {
            window.$chatwoot.toggle();
        } else if (window.botmanChatWidget) {
            window.botmanChatWidget.toggle();
        } else {
            // Fallback a WhatsApp si no hay chat interactivo disponible
            window.location.href = 'https://wa.me/5491156297160';
        }
    }
};
