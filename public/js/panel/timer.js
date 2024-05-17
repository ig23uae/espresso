// Инициализация таймера
let inactivityTimer;

function resetTimer() {
    // Сброс предыдущего таймера
    clearTimeout(inactivityTimer);

    // Установка нового таймера
    inactivityTimer = setTimeout(() => {
        // Действие после 3 минут бездействия
        console.log("Бездействие в течение 3 минут");
        // Например, переадресация на другую страницу
        window.location.href = '/panel/auth';
    }, 180000); // 180000 мс = 3 минуты
}

// Добавление событий для сброса таймера при действиях пользователя
window.onload = resetTimer;
document.onmousemove = resetTimer;
document.onkeypress = resetTimer;
document.onclick = resetTimer;
document.onscroll = resetTimer;
document.onwheel = resetTimer;
