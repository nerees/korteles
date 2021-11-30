  document.addEventListener('DOMContentLoaded', function() {
  let modalError = document.getElementById('modalerror');
  let modalApi = document.getElementById('modalapi');
  let modalGalioja = document.getElementById('modalGalioja');

  let options = {
  opacity : 0.5,
  inDuration : 250,
  outDuration : 250
}
  let errorInstance = M.Modal.init(modalError, options);
  let apiInstance = M.Modal.init(modalApi, options);
  let galiojaInstance = M.Modal.init(modalGalioja, options);

  const queryString = window.location.search;
  const urlParams = new URLSearchParams(queryString);
  const error1 = urlParams.get('error');
  const api = urlParams.get('api');
  const nominalas = urlParams.get('nominalas');
  const galiojaiki = urlParams.get('galioja');

  if (error1 != null && error1.length > 0) {
  errorInstance.open();
}
  if (api != null && api.length > 0) {
  apiInstance.open();
}
  if (nominalas != null && nominalas.length > 0) {
  let frontNominalas = document.getElementById('nominalas');
  let frontGalioja = document.getElementById('galiojimas');

  let imgKortele = document.createElement('img');

  if (nominalas === "10") {
  imgKortele.src = 'img/10.webp';
}
  if (nominalas === "15") {
  imgKortele.src = 'img/15.webp';
}
  if (nominalas === "20") {
  imgKortele.src = 'img/120.webp';
}
  if (nominalas === "30") {
  imgKortele.src = 'img/30.webp';
}

  frontNominalas.appendChild(imgKortele);

  if (galiojaiki != null && galiojaiki.length > 0) {
  frontGalioja.innerText = "Dovanų kortelė galioja: " + galiojaiki;
}else {
  frontGalioja.innerText = "Dovanų kortelė NEGALIOJA:";
}


  galiojaInstance.open();
}

  let submitButton = document.getElementById('submit_form');
  submitButton.addEventListener('click', function() {
  document.getElementById('search_form').submit();
})

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

