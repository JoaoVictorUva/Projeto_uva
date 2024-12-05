document.addEventListener("DOMContentLoaded", function () {
    var cepElement = document.getElementsByClassName('cep');

    console.log(cepElement);

    if (cepElement) {
        // Cria uma nova instância do Inputmask para a máscara de CEP
        var mask = new Inputmask({
            mask: '99999-999[9]',
            greedy: false,  // Evita que a máscara preencha com o '_'
            oncomplete: function () {
                // Quando a máscara estiver completa, o valor estará correto
            }
        });
        mask.mask(cepElement);
    }


    var mask = new Inputmask({
        mask: '999.999.999-99',
        greedy: false,  // Evita que a máscara preencha com o '_'
        onincomplete: function () {
            // Remove o '_' caso o número não esteja completo
            this.el.inputmask.setValue(this.el.inputmask.unmaskedvalue().slice(0, -1));
        }
    });

    var cpfElement = document.getElementsByClassName('cpf');
    mask.mask(cpfElement);




    var mask = new Inputmask({
        mask: ['(99) 9999-9999', '(99) 99999-9999'], // Permite tanto com 9 dígitos quanto sem
        greedy: false,
        onincomplete: function () {
            // Remove o '_' caso o número tenha menos de 10 ou 11 dígitos
            this.el.inputmask.setValue(this.el.inputmask.unmaskedvalue().slice(0, -1));
        }
    });

    var telefoneElement = document.getElementsByClassName('telefone');
    mask.mask(telefoneElement);

    var mask = new Inputmask('99/99/9999', {
        greedy: false,  // Evita que a máscara preencha com '_'
        onincomplete: function () {
            // Remove o caractere '_' caso a data não seja preenchida completamente
            this.el.inputmask.setValue(this.el.inputmask.unmaskedvalue().slice(0, -1));
        }
    });

    var dataElement = document.getElementsByClassName('data');
    var dataIncricaoInicio = document.getElementById('inscricao_inicio');
    var dataIncricaoFim = document.getElementById('inscricao_fim');

    mask.mask(dataElement);

    mask.mask(dataIncricaoInicio);
    mask.mask(dataIncricaoFim);

    var mask = new Inputmask('99/99/9999', {
        greedy: false,  // Evita que a máscara preencha com '_'
        onincomplete: function () {
            // Remove o caractere '_' caso a data não seja preenchida completamente
            this.el.inputmask.setValue(this.el.inputmask.unmaskedvalue().slice(0, -1));
        }
    });

    var dataIncricaoInicio = document.getElementById('inscricao_inicio');
    var dataIncricaoFim = document.getElementById('inscricao_fim');

    mask.mask(dataIncricaoInicio);
    mask.mask(dataIncricaoFim);

});