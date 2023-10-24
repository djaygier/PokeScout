function addToCart(id) {
  cookieValue = document.cookie;

  cartList = [];

  if (cookieValue != "") {
    cartList = cookieValue.split(";");
    cartList = JSON.parse(cartList[0].split("=")[1]);
  }

  cartList.push(id);

  expire = new Date();
  expire.setTime(expire.getTime() + 1000000000000000000);
  expire.toUTCString();

  document.cookie = `cart=${JSON.stringify(cartList)};expires=${expire};`;
}
