function addToCart(id, name, price, image) {
  cookieValue = document.cookie;

  cartList = [];

  if (cookieValue != "") {
    cartList = cookieValue.split(";");
    cartList = JSON.parse(cartList[0].split("=")[1]);
  }

  contains = false;

  for (let i = 0; i < cartList.length; i++) {
    if (cartList[i]["id"] == id) {
      contains = true;
      cartList[i]["quantity"]++;
    }
  }

  if (!contains) {
    cartList.push({
      id: id,
      name: name,
      price: price,
      image: image,
      quantity: 1,
    });
  }

  expire = new Date();
  expire.setTime(expire.getTime() + 10000000000000);
  expire.toUTCString();

  document.cookie = `cart=${JSON.stringify(cartList)};expires=${expire};`;

  setNewCount();
}

function getCartItems() {
  cookieValue = document.cookie;
  cartList = cookieValue.split(";");
  cartList = JSON.parse(cartList[0].split("=")[1]);

  for (let i = 0; i < cartList.length; i++) {
    let cards = document.querySelector("cards");

    let card = document.createElement("card");
    cards.append(card);

    let image = document.createElement("img");
    image.src = `media/${cartList[i]["image"]}`;
    card.append(image);

    let row = document.createElement("row");
    card.append(row);

    let name = document.createElement("div");
    name.className = "name";
    name.innerHTML = cartList[i]["name"];
    row.append(name);

    let quantity = document.createElement("input");
    quantity.className = "quantity";
    quantity.value = cartList[i]["quantity"];
    quantity.addEventListener(
      "input",
      function () {
        countTotals();
      },
      true
    );
    row.append(quantity);

    let price = document.createElement("div");
    price.className = "price";
    price.innerHTML = "€" + cartList[i]["price"];
    price.value = cartList[i]["price"];
    card.append(price);
  }
}

function countTotals() {
  let items = document.querySelectorAll("card");
  for (let i = 0; i < items.length; i++) {
    items[i].querySelector(".price").innerHTML =
      "€" +
      (
        items[i].querySelector(".quantity").value *
        items[i].querySelector(".price").value
      ).toFixed(2);

    if (items[i].querySelector(".quantity").value == 0) {
      cookieValue = document.cookie;
      cartList = cookieValue.split(";");
      cartList = JSON.parse(cartList[0].split("=")[1]);
      cartList.splice(i, 1);
      expire = new Date();
      expire.setTime(expire.getTime() + 10000000000000);
      expire.toUTCString();

      document.cookie = `cart=${JSON.stringify(cartList)};expires=${expire};`;
      items[i].remove();
    }

    cookieValue = document.cookie;
    cartList = cookieValue.split(";");
    cartList = JSON.parse(cartList[0].split("=")[1]);
    cartList[i]["quantity"] = parseInt(
      items[i].querySelector(".quantity").value
    );
    expire = new Date();
    expire.setTime(expire.getTime() + 10000000000000);
    expire.toUTCString();

    document.cookie = `cart=${JSON.stringify(cartList)};expires=${expire};`;
  }
  setNewCount();

  cookieValue = document.cookie;
  cartList = cookieValue.split(";");
  cartList = JSON.parse(cartList[0].split("=")[1]);

  document.getElementById("items").value = JSON.stringify(cartList);
}

function oncartload() {
  const queryString = window.location.search;
  if (queryString == "?status=success") {
    cartList = [];
    document.cookie = `cart=[];expires=Thu, 01 Jan 1970 00:00:00 UTC;`;
    document.location = "cart.html";
  }
}
