$(document).ready(() => {
    $('#postMessage').click((e) => {
        e.preventDefault()
        var url = $('form').serialize(); // serialize <form>data

        function getUrlVars(url) {
            var hash
            var myJson = {};

            var hashes = url.slice(url.indexOf('?') + 1).split('&');
            for (var i = 0; i < hashes.length; i++) {
                hash = hashes[i].split('=')
                myJson[hash[0]] = hash[1]
            }
            return JSON.stringify(myJson);
        }

        var test = getUrlVars(url)

        $.ajax({
            type: 'POST',
            url: 'api/post/create.php',
            data: test,
            ContentType: "application/json",
            success: () => alert('successfully uploaded post'),
            error: () => alert('Could not be posted')
        })

    })


    function docq(attr) {
        return document.querySelector(attr)
    }

    document.addEventListener('DOMContentLoaded', () => {

        document.getElementById('getMessage').onclick = () => {
            var req
            req = new XMLHttpRequest()
            req.open("GET", "localhost/php_blog_restapi/api/post/read.php", true)
            req.send()

            req.onload = () => {

                var json = JSON.parse(req.ResponseText)


                var son = json.filter( val => val.id > 4)
                var html = "";

                son.forEach((val) => {

                    var keys = Object.keys(val)

                    html += "<div class='cat'>"
                    keys.forEach((key) => {
                        html += `<strong> ${key} </strong> ${val[key]}} `

                    })
                    html += `</div> <Br>`
                })

                document.querySelector('.message')[0].innerHTML = html
            }


        }
    })


})




// req.onload=function(){
//     var json=JSON.parse(req.responseText);

//     //limit data called
//     var son = json.filter(function(val) {
//            return (val.id >= 4);  
//        });

//    var html = "";

//    //loop and display data
//    son.forEach(function(val) {
//        var keys = Object.keys(val);

//        html += "<div class = 'cat'>";
//            keys.forEach(function(key) {
//            html += "<strong>" + key + "</strong>: " + val[key] + "<br>";
//            });
//        html += "</div><br>";
//    });

//    //append in message class
//    document.getElementsByClassName('message')[0].innerHTML=html;         
//    };
