function editdesc(but) {
  // get parent and then first child <div>
  var div0 = but.parentNode.parentNode.childNodes[0].nextSibling
  var ih = div0.innerHTML // record the text of div
  
  div0.innerHTML = "<textarea type='text' rows='1' style='width:100%;'/>" // insert an input
  div0.firstElementChild.value = ih // set input value


  // now get buttons and change visibility
  but.style.visibility = 'hidden' // edit button
  but.parentNode.nextSibling.firstChild.style.visibility = 'visible'
}

function savedesc(but) {
  // get parent and then first child <div>
    var div0 = but.parentNode.parentNode.childNodes[0].nextSibling
    update_value(div0.id, div0.firstElementChild.value) // send id and new text to ajax function

    // now Restore back to normal mode
    div0.innerHTML = div0.firstElementChild.value
    but.parentNode.previousSibling.firstElementChild.style.visibility = 'visible'
    but.style.visibility = 'hidden'
}

function update_desc(id, value) {
    var xhttp
    if (window.XMLHttpRequest) {
        // code for modern browsers
        xhttp = new XMLHttpRequest()
    } else {
        // code for IE6, IE5
        xhttp = new ActiveXObject('Microsoft.XMLHTTP')
    }
    xhttp.open('GET', 'functions/profile_page_func.php?id=' + id + '&value=' + value + '&status=Save', true)
    xhttp.send(null)
        // console.log(status);
}

function edit(but) {
  // get parent and then first child <div>
  var div0 = but.parentNode.parentNode.childNodes[0].nextSibling
  var ih = div0.innerHTML // record the text of div
  //alert(ih)
  div0.innerHTML = "<input type='text' />" // insert an input
  div0.firstElementChild.value = ih // set input value

  // now get buttons and change visibility
  but.style.visibility = 'hidden' // edit button
  but.parentNode.nextSibling.firstChild.style.visibility = 'visible'
}


function save(but) {
    // get parent and then first child <div>
    var div0 = but.parentNode.parentNode.childNodes[0].nextSibling
    update_value(div0.id, div0.firstElementChild.value) // send id and new text to ajax function

    // now Restore back to normal mode
    div0.innerHTML = div0.firstElementChild.value
    but.parentNode.previousSibling.firstElementChild.style.visibility = 'visible'
    but.style.visibility = 'hidden'
}

function update_value(id, value) {
    var xhttp
    if (window.XMLHttpRequest) {
        // code for modern browsers
        xhttp = new XMLHttpRequest()
    } else {
        // code for IE6, IE5
        xhttp = new ActiveXObject('Microsoft.XMLHTTP')
    }
    xhttp.open('GET', 'functions/profile_page_func.php?id=' + id + '&value=' + value + '&status=Save', true)
    xhttp.send(null)
        // console.log(status);
}