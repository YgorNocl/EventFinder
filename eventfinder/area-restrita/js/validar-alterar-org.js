function formatarNumeroCelular(input) {
    let value = input.value;
  
    value = value.replace(/\D/g, ""); // Remove caracteres não numéricos
    value = value.replace(/^(\d{2})(\d)/g, "($1) $2"); // Coloca parênteses em volta dos primeiros dois dígitos
    value = value.replace(/(\d)(\d{4})$/, "$1-$2"); // Coloca hífen entre o quarto e o quinto dígitos
  
    input.value = value;
  }

function formatarDocumento(input) {
    let valor = input.value.replace(/\D/g, '');

    if (valor.length <= 11) {
        valor = valor.replace(/(\d{3})(\d)/, '$1.$2');
        valor = valor.replace(/(\d{3})(\d)/, '$1.$2');
        valor = valor.replace(/(\d{3})(\d{1,2})$/, '$1-$2');
    } else {
        valor = valor.replace(/^(\d{2})(\d)/, '$1.$2');
        valor = valor.replace(/^(\d{2})\.(\d{3})(\d)/, '$1.$2.$3');
        valor = valor.replace(/\.(\d{3})(\d)/, '.$1/$2');
        valor = valor.replace(/(\d{4})(\d)/, '$1-$2');
    }

    input.value = valor;
}

function formatarCelular(input) {
    let valor = input.value.replace(/\D/g, '');

    valor = valor.replace(/^(\d{2})(\d)/g, '($1) $2');
    valor = valor.replace(/(\d)(\d{4})$/, '$1-$2');

    input.value = valor;
}


function validarCPF(cpf) {
    // Remove caracteres não numéricos
    cpf = cpf.replace(/\D/g, '');

    // Verifica se o CPF possui 11 dígitos
    if (cpf.length !== 11) {
        return false;
    }

    // Verifica se todos os dígitos são iguais, ex: 11111111111
    if (/^(\d)\1*$/.test(cpf)) {
        return false;
    }

    // Calcula os dígitos verificadores
    let soma = 0;
    let resto;

    for (let i = 1; i <= 9; i++) {
        soma = soma + parseInt(cpf.substring(i - 1, i)) * (11 - i);
    }

    resto = (soma * 10) % 11;

    if (resto === 10 || resto === 11) {
        resto = 0;
    }

    if (resto !== parseInt(cpf.substring(9, 10))) {
        return false;
    }

    soma = 0;
    for (let i = 1; i <= 10; i++) {
        soma = soma + parseInt(cpf.substring(i - 1, i)) * (12 - i);
    }

    resto = (soma * 10) % 11;

    if (resto === 10 || resto === 11) {
        resto = 0;
    }

    if (resto !== parseInt(cpf.substring(10, 11))) {
        return false;
    }

    return true;
}

function validarDataNascimento(data) {
    // Verifica se a data está no formato válido (aaaa-mm-dd)
    const regex = /^\d{4}-\d{2}-\d{2}$/;
    if (!regex.test(data)) {
        return false;
    }

    // Converte a string da data em um objeto Date
    const dataNascimento = new Date(data);

    // Verifica se a data é válida e não é posterior à data atual
    const dataAtual = new Date();
    if (
        isNaN(dataNascimento.getTime()) || // Verifica se é um valor numérico válido
        dataNascimento.toISOString().slice(0, 10) !== data || // Verifica se a data é válida após o parse
        dataNascimento > dataAtual // Verifica se a data é posterior à data atual
    ) {
        return false;
    }

    return true;
}
 
function validarCNPJ(cnpj) {
    // Remove caracteres não numéricos
    cnpj = cnpj.replace(/\D/g, '');

    // Verifica se o CNPJ possui 14 dígitos
    if (cnpj .length !== 14) {
        return false;
    }

    // Verifica se todos os dígitos são iguais, ex: 11111111111111
    if (/^(\d)\1*$/.test(cnpj)) {
        return false;
    }

    // Calcula o primeiro dígito verificador
    let soma = 0;
    let peso = 2;

    for (let i = 11; i >= 0; i--) {
        soma += parseInt(cnpj.charAt(i)) * peso;
        peso = peso === 9 ? 2 : peso + 1;
    }

    let resto = soma % 11;
    const primeiroDigitoVerificador = resto < 2 ? 0 : 11 - resto;

    if (parseInt(cnpj.charAt(12)) !== primeiroDigitoVerificador) {
        return false;
    }

    // Calcula o segundo dígito verificador
    soma = 0;
    peso = 2;

    for (let i = 12; i >= 0; i--) {
        soma += parseInt(cnpj.charAt(i)) * peso;
        peso = peso === 9 ? 2 : peso + 1;
    }

    resto = soma % 11;
    const segundoDigitoVerificador = resto < 2 ? 0 : 11 - resto;

    if (parseInt(cnpj.charAt(13)) !== segundoDigitoVerificador) {
        return false;
    }

    return true;
}

function validarCelular(celular) {
    // Remove caracteres não numéricos
    celular = celular.replace(/\D/g, '');

    // Verifica se o celular possui 11 dígitos
    if (celular.length !== 11) {
        return false;
    }

    // Verifica se o primeiro dígito do celular é válido (DDD)
    const ddd = celular.substring(0, 2);
    const dddValidos = ['11', '12', '13', '14', '15', '16', '17', '18', '19', '21', '22', '24', '27', '28', '31', '32', '33', '34', '35', '37', '38', '41', '42', '43', '44', '45', '46', '47', '48', '49', '51', '53', '54', '55', '61', '62', '63', '64', '65', '66', '67'];

    if (!dddValidos.includes(ddd)) {
        return false;
    }

    return true;
}

function validarEmail(email) {
    // Regex para validar o formato do email
    const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return regex.test(email);
}



function validarFormularioOrganizador() {
    const documentoInput = document.getElementById('documento');
    const documentoError = document.getElementById('documentoError');
    const dataNascimentoInput = document.getElementById('dataNascimento');
    const dataNascimentoError = document.getElementById('dataNascimentoError');
    const celularInput = document.getElementById('celular');
    const celularError = document.getElementById('celularError');
    const emailInput = document.getElementById('email');
    const emailError = document.getElementById('emailError');


    let formValido = true;

    // Limpa as mensagens de erro
    documentoError.textContent = '';
    dataNascimentoError.textContent = '';
    celularError.textContent = '';
    emailError.textContent = '';


    // Validação do documento (CPF ou CNPJ)
    const documento = documentoInput.value.trim();
    if (documento !== '' && !validarCPF(documento) && !validarCNPJ(documento)) {
        documentoError.textContent = 'Documento inválido';
        formValido = false;
    }

    // Validação da data de nascimento
    const dataNascimento = dataNascimentoInput.value.trim();
    if (dataNascimento !== '' && !validarDataNascimento(dataNascimento)) {
        dataNascimentoError.textContent = 'Data de nascimento inválida';
        formValido = false;
    }

    // Validação do celular
    const celular = celularInput.value.trim();
    if (celular !== '' && !validarCelular(celular)) {
        celularError.textContent = 'Celular inválido';
        formValido = false;
    }

    // Validação do email
    const email = emailInput.value.trim();
    if (email !== '' && !validarEmail(email)) {
        emailError.textContent = 'Email inválido';
        formValido = false;
    }

    

    return formValido;
}

document.addEventListener('DOMContentLoaded', function() {
    const documentoInput = document.getElementById('documento');
    documentoInput.addEventListener('input', function() {
        formatarDocumento(this);
    });

    const celularInput = document.getElementById('celular');
    celularInput.addEventListener('input', function() {
        formatarCelular(this);
    });
});
