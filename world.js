window.onload = function() {

    let lookupbtn = $("#lookup")
    let lookupbtncity = $("#lookupCity")
    let searchRequest = document.getElementById('country');
    
    lookupbtn.click(function (e) { 
        e.preventDefault();
        console.log("Clicked");
        let input = searchRequest.value
        httpRequest= new XMLHttpRequest();
        var url = "http://localhost/info2180-lab5/world.php?country="+ input; 
        httpRequest.onreadystatechange=loadMessage;
        httpRequest.open('GET',url);
        httpRequest.send();
        console.log(url);
    });

    lookupbtncity.click(function (e) { 
        e.preventDefault();
        console.log("Clicked");
        let input = searchRequest.value
        httpRequest= new XMLHttpRequest();
        let context = "&context=cities";
        var url = "http://localhost/info2180-lab5/world.php?country="+ input + context; 
        httpRequest.onreadystatechange=loadMessage;
        httpRequest.open('GET',url);
        httpRequest.send();
        console.log(url);
    });

    function loadMessage(){
        if (httpRequest.readyState === XMLHttpRequest.DONE){
            if (httpRequest.status === 200){
                var response = httpRequest.responseText;
                var results = document.querySelector('#result')
                results.innerHTML = response;
                //alert(response)
            }else{
                alert('There was a problem with the request.')
            }
        }
    }
   }