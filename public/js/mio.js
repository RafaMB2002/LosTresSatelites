$(document).ready(function () {
  $.ajax({
    method: "GET",
    url: "/api/mensaje/getAll",
    dataType: "json",
  }).done(function (data) {
    var dataSet = [];
    for (let i = 0; i < data.length; i++) {
      var data2 = [
        data[0].object.fecha_hora.date.toString(),
        data[0].object.modo_id,
        data[0].object.user_id,
      ];
      dataSet.push(data2);
    }
    $("#myTable").DataTable({
      data: dataSet,
    });
  });
});
