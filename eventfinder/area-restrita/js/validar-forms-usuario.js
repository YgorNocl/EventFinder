function formatarNumeroCelular(celular) {
    celular = celular.replace(/\D/g, ""); // Remove caracteres não numéricos
    celular = celular.replace(/^(\d{2})(\d)/g, "($1) $2"); // Coloca parênteses em volta dos primeiros dois dígitos
    celular = celular.replace(/(\d)(\d{4})$/, "$1-$2"); // Coloca hífen entre o quarto e o quinto dígitos
  
    return celular;
  }
  

function formatarCPF(cpf) {
  cpf = cpf.replace(/\D/g, "");

  if (cpf.length > 3 && cpf.length <= 6) {
    cpf = cpf.replace(/(\d{3})(\d+)/, "$1.$2");
  } else if (cpf.length > 6 && cpf.length <= 9) {
    cpf = cpf.replace(/(\d{3})(\d{3})(\d+)/, "$1.$2.$3");
  } else if (cpf.length > 9) {
    cpf = cpf.replace(/(\d{3})(\d{3})(\d{3})(\d+)/, "$1.$2.$3-$4");
  }

  return cpf;
}

function validarCPF(cpf) {
  // Remove caracteres não numéricos
  cpf = cpf.replace(/\D/g, "");

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
    soma += parseInt(cpf.substring(i - 1, i)) * (11 - i);
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
    soma += parseInt(cpf.substring(i - 1, i)) * (12 - i);
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

function validarCelular(celular) {
  // Remove caracteres não numéricos
  celular = celular.replace(/\D/g, "");

  // Verifica se o celular possui 11 dígitos
  if (celular.length !== 11) {
    return false;
  }

  // Verifica se o primeiro dígito do celular é válido (DDD)
  const ddd = celular.substring(0, 2);
  const dddValidos = [
    "11", "12", "13", "14", "15", "16", "17", "18", "19", "21", "22", "24", "27", "28", "31",
    "32", "33", "34", "35", "37", "38", "41", "42", "43", "44", "45", "46", "47", "48", "49",
    "51", "53", "54", "55", "61", "62", "63", "64", "65", "66", "67", "68", "69", "71", "73",
    "74", "75", "77", "79", "81", "82", "83", "84", "85", "86", "87", "88", "89", "91", "92",
    "93", "94", "95", "96", "97", "98", "99"
  ];
  if (!dddValidos.includes(ddd)) {
    return false;
  }

  // Outras validações do número de celular, se necessário...

  return true;
}

function validarSenha(senha) {
  // Mínimo de 8 caracteres
  if (senha.length < 8) {
    return false;
  }

  // Pelo menos uma letra maiúscula
  if (!/[A-Z]/.test(senha)) {
    return false;
  }

  // Pelo menos uma letra minúscula
  if (!/[a-z]/.test(senha)) {
    return false;
  }

  // Pelo menos um número
  if (!/\d/.test(senha)) {
    return false;
  }

  // Pelo menos um caractere especial
  if (!/[^A-Za-z0-9]/.test(senha)) {
    return false;
  }

  return true;
}

function validarEmail(email) {
  // Expressão regular para validar o formato do email
  const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  return regex.test(email);
}

function validarFormulario() {
  const cpfInput = document.getElementById("cpfUsuario");
  const cpf = cpfInput.value;
  const cpfErrorElement = document.getElementById("cpfError");

  const dataNascInput = document.getElementById("dataNasc");
  const dataNasc = dataNascInput.value;
  const dataNascErrorElement = document.getElementById("dataNascError");

  const celInput = document.getElementById("celUsuario");
  const cel = celInput.value;
  const celErrorElement = document.getElementById("celError");

  const senhaInput = document.getElementById("senhaUsuario");
  const senha = senhaInput.value;
  const senhaErrorElement = document.getElementById("senhaError");

  const emailInput = document.getElementById("emailUsuario");
  const email = emailInput.value;
  const emailErrorElement = document.getElementById("emailError");

  let formValido = true;

  // Validação do CPF
  if (!validarCPF(cpf)) {
    cpfErrorElement.style.display = "block";
    cpfInput.focus();
    formValido = false;
  } else {
    cpfErrorElement.style.display = "none";
  }

  // Validação da data de nascimento
  if (!validarDataNascimento(dataNasc)) {
    dataNascErrorElement.style.display = "block";
    dataNascInput.focus();
    formValido = false;
  } else {
    dataNascErrorElement.style.display = "none";
  }

  // Validação do celular
  if (!validarCelular(cel)) {
    celErrorElement.style.display = "block";
    celInput.focus();
    formValido = false;
  } else {
    celErrorElement.style.display = "none";
  }

  // Validação da senha
  if (!validarSenha(senha)) {
    senhaErrorElement.style.display = "block";
    senhaInput.focus();
    formValido = false;
  } else {
    senhaErrorElement.style.display = "none";
  }

  // Validação do email
  if (!validarEmail(email)) {
    emailErrorElement.style.display = "block";
    emailInput.focus();
    formValido = false;
  } else {
    emailErrorElement.style.display = "none";
  }

  return formValido;
}

document.addEventListener("DOMContentLoaded", function () {
  const documentoInput = document.getElementById("cpfUsuario");
  documentoInput.addEventListener("input", function () {
    this.value = formatarCPF(this.value);
  });

  const celInput = document.getElementById("celUsuario");
  celInput.addEventListener("input", function () {
    this.value = formatarNumeroCelular(this.value);
  });
});
