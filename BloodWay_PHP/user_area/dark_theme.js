var icon = document.getElementById("icon");

icon.onclick = function () {
  var SetTheme = document.body;

  SetTheme.classList.toggle("dark-theme");

  var theme;

  if (SetTheme.classList.contains("dark-theme")) {
    console.log("Dark mode");
    theme = "DARK";
  } else {
    console.log("Light mode");
    theme = "LIGHT";
  }

  localStorage.setItem("PageTheme", JSON.stringify(theme));

  if (document.body.classList.contains("dark-theme")) {
    icon.src = "../images/sun.png";
  } else {
    icon.src = "../images/moon.png";
  }
};

let GetTheme = JSON.parse(localStorage.getItem("PageTheme"));
console.log(GetTheme);

if (GetTheme === "DARK") {
  document.body.classList = "dark-theme";
  icon.src = "../images/sun.png";
}

