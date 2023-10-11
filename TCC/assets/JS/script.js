
function logar(){
    let qlogin = document.getElementById('PagLog')
    // let buttom = document.getElementById('btn-login')
    let Relatorio = document.getElementById('PgRel')
    let nomes = document.getElementById('usuario').value;
    let senha = document.getElementById('senha').value;

    console.log(nomes)
    console.log(senha)

    if (nomes=="admin" && senha=="admin"){
        hidden(qlogin);
       
    }else{
        alert("login ou senha incorretos")
    };

    mostrar(Relatorio);

}

function hidden(ocutar){

  ocutar.classList.add('hidden');
    
}

function mostrar(show){
    show.classList.remove('hidden');
    show.classList.add('show');
}

function next(){
    
}
