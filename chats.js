const searchBar = document.querySelector(".chats .search input"),
searchBtn = document.querySelector(".chats .search button"),
chatList = document.querySelector(".chats .chat-list");

searchBtn.onclick = () => {
	searchBar.classList.toggle("active");
	searchBar.focus();
	searchBtn.classList.toggle("active");
	searchBar.value = "";
}

searchBar.onkeyup = () => {
	let searchTerm = searchBar.value;
	if(searchTerm != ""){
		searchBar.classList.add("active");
	} else {
		searchBar.classList.remove("active");
	}
	let xhr = new XMLHttpRequest();
	xhr.open("POST", "php/search.php", true);
	xhr.onload = () =>{
		if(xhr.readyState === XMLHttpRequest.DONE){
			if(xhr.status === 200){
				let data = xhr.response;
				chatList.innerHTML = data;
			}
		}
	}
	xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhr.send("searchTerm=" + searchTerm);
}

setInterval(() => {
	let xhr = new XMLHttpRequest();
	xhr.open("GET", "php/chats.php", true);
	xhr.onload = () =>{
		if(xhr.readyState === XMLHttpRequest.DONE){
			if(xhr.status === 200){
				let data = xhr.response;
				if(!searchBar.classList.contains("active")){
					chatList.innerHTML = data;
				}
			}
		}
	}
	xhr.send();
}, 500)
