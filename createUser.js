$(function() {
  $("#create").on("click",function(event){
    //入力値取得
    let id = $("#id").val();
    let name = $("#name").val();
    let password = $("#password").val();

    const data = {
      id: id,
      name: name,
      password: password,
    }

    //確認
    console.log(id);
    console.log(name);
    console.log(password);


    //jquey送信
    $.ajax({

      type: "POST",
      url: "./yosiki/asset/php/createUser.php",
      data,
      dataType: "json"

   })
  });
});