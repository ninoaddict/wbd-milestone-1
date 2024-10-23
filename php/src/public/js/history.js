document.querySelectorAll('.filter-button').forEach(button => {
    button.addEventListener('click', function(){
        const status = this.getAttribute('data-status');
        window.location.href = window.location.pathname + "?status="+ status;
    });
});

document.querySelectorAll('.history-card').forEach(button => {
    button.addEventListener('click', function(){
        const vacancyID = this.getAttribute('data-id');
        window.location.href = "/lowongan/"+ vacancyID;
    });
});