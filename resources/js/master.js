document.addEventListener('DOMContentLoaded', ()=>{
    const form = document.getElementById('addPosts');
    form.addEventListener('submit', (e)=>{
        const button =  form.querySelector('.btn-block')
        button.disabled = true
        button.innerHTML = `saving post....`
        e.preventDefault()
        const title = document.getElementById('title').value;
        const params = {
            title: title,
            _token: csrfToken,
        }
        fetch('/json', {
            method: 'POST',
            body: JSON.stringify(params),
            headers: {
                "Content-type": "application/json; charset=UTF-8"
            }
        }).then(res => res.json())
        .then(res => {
            const alert = document.getElementById('alert');
            alert.innerHTML = ' Se guardo con exito el post'
            alert.classList.toggle('d-none')
            button.disabled = false
            button.innerHTML = `Add`
            setTimeout(()=>{
                alert.classList.toggle('d-none')
            },2000)
        })
        form.reset();
    })


    // let array = [1,2,3,4,5,6];
    // let response = [];

    // array.map((item)=> {
    //     item % 2 == 0 ? response.push(item) : ''
    // })

    // console.log(response)
})