function setDateTime() {
    var time = new Date();
    
    var day = time.getDate();
    var temp = ((day < 10) ? "0" : "") + day + ".";
    
    var month = time.getMonth() + 1;
    temp += ((month < 10) ? "0" : "") + month + ".";
    
    temp += time.getFullYear() + " ";
    
    var hours = time.getHours();
    temp += ((hours < 10) ? "0" : "") + hours;
    
    var minute = time.getMinutes();
    temp += ((minute < 10) ? ":0" : ":") + minute;
    
    var second = time.getSeconds();
    temp += ((second < 10) ? ":0" : ":") + second;
    
    document.getElementById('datetime').innerHTML = temp;
    setTimeout(setDateTime,1000);
}
