const urlParams = new URLSearchParams(window.location.search);
const blog_id = urlParams.get('id');
const base_url = document.body.dataset.baseurl;
const commentsDiv = document.querySelector('.comments');
const currentUserId = localStorage.getItem('user_id');
const textarea = document.querySelector('.comment-textarea');
const addCommentBtn = document.querySelector('.add-button');
let btn = document.querySelector('.text-button');
const commentsNumber = document.querySelector('.comments-number');
function getComments(){
    axios.get(`${base_url}/api/comments/list.php?id=${blog_id}`).then(res =>{
        showComments(res.data);
    })
}

function showComments(comments){
    let commentsHTML = ``;
    comments.length == 0 ? commentsDiv.innerHTML = `<h2>0 комментарий</h2>` : commentsHTML = `<h2>${comments.length} комментариев</h2>`
    comments.length == 0 ? commentsNumber.innerHTML = `<p>0</p>` : commentsNumber.innerHTML = `<p>${comments.length}</p>`;
    for(let i = 0; i < comments.length; i++){
        let dropdown = ``;
        if(currentUserId == comments[i].user_id){
            dropdown += `
                <span class="link">
                <img src="images/dots.svg" alt="">
                Еще

                <ul class="dropdown">
                    <li> <a href="" onclick="editComment(${comments[i].id}, event)">Редактировать</a> </li>
                    <li><a href="" onclick="deleteComment(${comments[i].id})" class="danger">Удалить</a></li>
                </ul>
                </span>
            `
        }
        commentsHTML += `
        <div class="comment">
            <div class="comment-header">
                <img src="images/avatar.png" alt="">
                ${comments[i].full_name}
                ${dropdown}
            </div>
            <p class = "comment-text">
                ${comments[i].text}        
            </p>
        </div>
        `
    }
    if(comments.length > 0) commentsDiv.innerHTML = commentsHTML;
}
getComments();

addCommentBtn.onclick = function (){
    axios.post(base_url + '/api/comments/add.php' , {
        text : textarea.value,
        blog_id : blog_id 
    }).then(res =>{
        getComments();

        textarea.value = ``;
    })
}

function deleteComment(id){
    axios.get(`${base_url}/api/comments/delete.php?id=${id}`).then(
        getComments()
    )
}

function editComment(id, e){
    e.preventDefault();
    axios.get(base_url + `/api/comments/get.php?id=${id}`)
    .then(res =>{
        textarea.value = res.data.text;
        btn.innerHTML = `<button class="save-button" onclick="saveEditComment(${id}, event)">Сохранить</button>`;
    })
}
function saveEditComment(id){
    axios.post(base_url + '/api/comments/edit.php' , {
        text : textarea.value,
        id : id 
    }).then(res =>{
        getComments();
        textarea.value = ``;
        btn.innerHTML = `<button class="add-button">Отправить</button>`;
    })
}