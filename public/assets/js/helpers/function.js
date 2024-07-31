function disableElement(elementId) {
  $("#" + elementId)
    .addClass("disabled")
    .attr("disabled", true);
  localStorage.setItem(elementId + "Disabled", "true");
}

function enableElement(elementId) {
  $("#" + elementId)
    .removeClass("disabled")
    .removeAttr("disabled");
  localStorage.removeItem(elementId + "Disabled");
}

function checkElementStatusOnLoad(elementId) {
  if (localStorage.getItem(elementId + "Disabled") === "true") {
    disableElement(elementId);
  } else {
    enableElement(elementId);
  }
}
