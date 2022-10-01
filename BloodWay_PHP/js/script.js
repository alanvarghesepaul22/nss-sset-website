window.addEventListener("scroll", function () {
  var header = document.querySelector("header");
  header.classList.toggle("sticky", window.scrollY > 0);
});

$("#submit-form").submit((e) => {
    e.preventDefault();
    $.ajax({
      url: "https://script.google.com/macros/s/AKfycbxHf8HlbEp9re27Hg_ZFCwgFo-SdsYECkUmnVP_nPuT5gT9bzFf5EQPtZNgV-57aA4WpQ/exec",
      data: $("#submit-form").serialize(),
      method: "post",
      success: function (response) {
        alert("Form submitted successfully");
        window.location.reload();
        window.location.href="./index.php";
      },
      error: function (err) {
        alert("Something Error");
      },
    });
  });
