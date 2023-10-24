function setNewCount() {
  cookieValue = document.cookie;
  cartList = cookieValue.split(";");
  cartList = JSON.parse(cartList[0].split("=")[1]);

  let count = 0;
  for (let i = 0; i < cartList.length; i++) {
    count += cartList[i]["quantity"];
  }

  document.querySelector("count").innerHTML = count;
}
