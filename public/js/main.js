

function editPost(post){
    $('#caption').text(`${post.caption}`);
    $('#modalImage').attr('src', `/storage/${post.image}`);
    $(`#postForm`).attr('action', `/profile/update/${post.id}`);
    
    
}

function editProfile(user){
    $('#editProfile').attr('action', `/profile/${user.id}`);

}   

