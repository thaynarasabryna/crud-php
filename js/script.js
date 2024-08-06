// Início API ViaCEP
function limpa_formulário_cep() {
    $('#logradouro').val("");
    $('#bairro').val("");
    $('#cidade').val("");
    $('#uf').val("");
}

function pesquisacep(valor) {
    var cep = valor.replace(/\D/g, '');
    var url = 'https://viacep.com.br/ws/' + cep + '/json/';
    
    if (cep != "") {
        var validacep = /^[0-9]{8}$/;
        if (validacep.test(cep)) {
            $('#logradouro').val("...");
            $('#bairro').val("...");
            $('#cidade').val("...");
            $('#uf').val("...");
            
            $.ajax({
                url: url,
                dataType: 'json',
                success: function(conteudo) {
                    if (!("erro" in conteudo)) {
                        $('#logradouro').val(conteudo.logradouro);
                        $('#bairro').val(conteudo.bairro);
                        $('#cidade').val(conteudo.localidade);
                        $('#uf').val(conteudo.uf);
                    } else {
                        limpa_formulário_cep();
                        alert("CEP não encontrado.");
                    }
                },
                error: function() {
                    limpa_formulário_cep();
                    alert("Erro ao consultar o CEP.")
                }
            });
            
        } else {
            limpa_formulário_cep();
            alert("Formato de CEP inválido.");
        }
    }
}
// Fim API ViaCEP

// Modal
function carregaModal(id, nome) {
    $.ajax({
        url: 'modal.php',
        type: 'POST',
        data: {id: id, nome: nome},
        success: function(response) {
            $('#modalContainer').html(response);
            $('#modalExemplo-' + id).modal('show');
        }
    });
}

// Máscaras
$(document).ready(function(){
    // CPF
    var cpfMask = new Inputmask("999.999.999-99");
    cpfMask.mask($("#cpf"));

    // CEP
    var cepMask =new Inputmask("99999-999");
    cepMask.mask($("#cep"))
});
