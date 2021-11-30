document.addEventListener('DOMContentLoaded', function() {

  /*menu*/
  let menu_button = document.getElementById('menu_button');
  let menu_icon = document.getElementById('menu_icon');
  let menu = document.getElementById('menu');

  menu_button.addEventListener('click', function() {
    toggleClass(menu, 'open');
    if (menu_icon.innerText === "menu") {
      menu_icon.innerText = "close";
    }else{
      menu_icon.innerText = "menu";
    }
  })

});

function toggleClass(element, className){
  if (!element || !className){
    return;
  }

  let classString = element.className, nameIndex = classString.indexOf(className);
  if (nameIndex === -1) {
    classString += ' ' + className;
  }
  else {
    classString = classString.substr(0, nameIndex) + classString.substr(nameIndex+className.length);
  }
  element.className = classString;
}

function closeButton() {
  window.location.replace("/");
}

