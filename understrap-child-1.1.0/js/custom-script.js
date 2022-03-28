jQuery(document).ready(function ($) {
  let forms = document.getElementsByClassName("form-add-realestate");
  let validation = Array.prototype.filter.call(forms, function (form) {
    form.addEventListener(
      "submit",
      function (event) {
        if (form.checkValidity() === !1) {
          event.preventDefault();
          event.stopPropagation();
        } else {
          event.preventDefault();
          let formData = new FormData();
          let $form = $(form);
          formData.append("title", $("#formAddRealestTitle")[0].value);
          formData.append(
            "description",
            $("#formAddRealestDescription")[0].value
          );
          formData.append("square", $("#formAddRealestSq")[0].value);
          formData.append("price", $("#formAddRealestPrice")[0].value);
          formData.append("adress", $("#formAddRealestAdress")[0].value);
          formData.append("liveSq", $("#formAddRealestLivSq")[0].value);
          formData.append("floor", $("#formAddRealestFloor")[0].value);
          formData.append("type", $("#formAddRealestType")[0].value);
          formData.append("city", $("#formAddRealestCity")[0].value);
          formData.append("image", $("#formAddRealestImg")[0].files[0]);
          $.ajax({
            type: $form.attr("method"),
            url: $form.attr("action"),
            cache: false,
            contentType: false,
            processData: false,
            data: formData,
          })
            .done(function (data) {
              console.log("🚀 ~ file: custom-script.js ~ line 36 ~ data", data)
              let result = JSON.parse(data);
            })
            .fail(function (data) {});
        }
        form.classList.add("was-validated");
      },
      !1
    );
  });
});
