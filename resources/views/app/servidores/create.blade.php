<form action="/prefeitura/{{$prefeitura->id}}/servidores/store" enctype="multipart/form-data" method="POST">
@csrf
    <div class="card shadow bg-light">
        <div class="card-body">
            <small>dados gerais</small>
            <hr>
            <div class="form-row">
                <div class="form-group col-md-10">
                    <label class="font-weight-bold" for=""> Nome completo </label>
                    <div id="cp2" class="input-group" title="Using input value">
                        <input type="text" name="nome" class="form-control input-lg" id="nome" required="required"/>
                    </div>
                </div>
                <div class="form-group col-md-2">
                    <label class="font-weight-bold">Data de nascimento</label>
                    <input type="date" name="nascido_em" class="form-control" id="nascido_em" required="required">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label class="font-weight-bold" for="">RG</label>
                    <input type="text" maxlenght="10" name="rg" class="form-control input-lg" id="rg"required="required" />
                    
                </div>
                <div class="form-group col-md-4">
                    <label class="font-weight-bold">CPF</label>
                    <input-cpf-component></input-cpf-component>
                </div>
                <div class="form-group col-md-4">
                    <label class="font-weight-bold">Matricula</label>
                    <input type="text" name="matricula" class="form-control" id="matricula" required="required">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label class="font-weight-bold" for="">Sexo</label>
                    <select name="sexo" id="sexo" class="form-control">
                        <option value="M">Masculino</option>
                        <option value="F">Feminino</option>
                        <option value="O">Outros</option>
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label class="font-weight-bold">Nome do Pai</label>
                    <input type="text" name="nome_pai" class="form-control" id="nome_pai" >
                </div>
                <div class="form-group col-md-4">
                    <label class="font-weight-bold">Nome da mãe</label>
                    <input type="text" name="nome_mae" class="form-control" id="nome_mae" >
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label class="font-weight-bold" for="">Etnia</label>
                    <select name="etnia" id="etnia" class="form-control">
                        <option value="branco">Branco</option>
                        <option value="negro">Negro</option>
                        <option value="indigena">Indígena</option>
                        <option value="caboclo">Caboclo</option>
                        <option value="pardo">Pardo</option>
                        <option value="mulato">Mulato</option>
                        <option value="cafuzo">Cafuzo</option>
                    </select>
                    
                </div>
                <div class="form-group col-md-4">
                    <label class="font-weight-bold">Telefone</label>
{{--                    <input type="tel" name="tel" class="form-control" id="tel" >--}}
                    <input-tel-component></input-tel-component>
                </div>
                <div class="form-group col-md-4">
                    <label class="font-weight-bold">Celular</label>
                    <input-cel-component></input-cel-component>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label class="font-weight-bold" for="">Grau Escolaridade</label>
                    <select name="grau_escolaridade" id="grau_escolaridade" class="form-control">
                        <option value="fundamental_incompleto">Fundamental - Incompleto</option>
                        <option value="fundamental_completo">Fundamental - Completo</option>
                        <option value="medio_incompleto">Médio - Incompleto</option>
                        <option value="medio_completo">Médio - Completo</option>
                        <option value="superior_incompleto">Superior - Incompleto</option>
                        <option value="superior_completo">Superior - Completo</option>
                        <option value="pos_latu_incompleto">Pós-graduação (Lato senso) - Incompleto</option>
                        <option value="pos_latu_completo">Pós-graduação (Lato senso) - Completo</option>
                        <option value="mes_str_incompleto">Pós-graduação (Stricto sensu, nível mestrado) - Incompleto</option>
                        <option value="mes_str_completo">Pós-graduação (Stricto sensu, nível mestrado) - Completo</option>
                        <option value="doc_str_incompleto">Pós-graduação (Stricto sensu, nível doutor) - Incompleto</option>
                        <option value="doc_str_completo">Pós-graduação (Stricto sensu, nível doutor) - Completo</option>
                    </select>
                </div>
                <!-- <div class="form-group col-md-4">
                    <label class="font-weight-bold">Telefone</label>
                    <input type="text" name="tel" class="form-control" id="tel" >
                </div>
                <div class="form-group col-md-4">
                    <label class="font-weight-bold">Celular</label>
                    <input type="text" name="cel" class="form-control" id="cel">
                </div> -->
            </div>
        </div>
    </div>
    <br>
    <div class="card shadow bg-warning">
        <div class="card-body">
            <small>endereço</small>
            <hr>
            <endereco-component></endereco-component>
        </div>
    </div>
    
    <br>
    <div class="card shadow bg-light">
        <div class="card-body">
            <small>alocação e situação funcional</small>
            <hr>
            <div class="form-row">
            <div class="form-group col-md-4">
                <label class="font-weight-bold" for="">Secretaria </label>
                <div id="cp2" class="input-group" title="Using input value">
                    <select name="id_secretaria" id="id_secretaria" class="form-control">
                        <option  value="-1">Não vinculado</option>
                        @foreach($secretarias as $secretaria)
                            <option value="{{$secretaria->id}}">{{$secretaria->nome}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group col-md-4">
                <label class="font-weight-bold" for="">Departamento </label>
                <div id="cp2" class="input-group" title="Using input value">
                    <select name="id_departamento" id="id_departamento" class="form-control">
                        <option  value="-1">Não vinculado</option>
                        @foreach($departamentos as $departamento)
                            <option value="{{$departamento->id}}">{{$departamento->nome}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group col-md-4">
                <label class="font-weight-bold" for="">Órgão</label>
                <div id="cp2" class="input-group" title="Using input value">
                    <select name="id_orgao" id="id_orgao" class="form-control">
                        <option  value="-1">Não vinculado</option>
                        @foreach($orgaos as $orgao)
                            <option value="{{$orgao->id}}">{{$orgao->nome}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-4">
                <label class="font-weight-bold" for="">Fundação</label>
                <div id="cp2" class="input-group" title="Using input value">
                    <select name="id_fundacao" id="id_fundacao" class="form-control">
                        <option  value="-1">Não vinculado</option>
                        @foreach($fundacoes as $fundacao)
                            <option value="{{$fundacao->id}}">{{$fundacao->nome}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group col-md-4">
                <label class="font-weight-bold" for="">Cargo</label>
                <div id="cp2" class="input-group" title="Using input value">
                    <select name="id_cargo" id="id_cargo" class="form-control">
                        @foreach($cargos as $cargo)
                            <option value="{{$cargo->id}}">{{$cargo->nome}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group col-md-4">
                <label class="font-weight-bold" for="">Situação funcional</label>
                <div id="cp2" class="input-group" title="Using input value">
                    <select name="id_situacao_funcional" id="id_situacao_funcional" class="form-control" required="required">
                        @foreach($situacoesFuncionais as $funcional)
                            <option value="{{$funcional->id}}">{{$funcional->nome}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-4">
                <label class="font-weight-bold" for="">Situação cadastral</label>
                <div id="cp2" class="input-group" title="Using input value">
                    <select name="id_situacao_cadastral" id="id_situacao_cadastral" class="form-control" required="required">
                        @foreach($situacoesCadastrais as $cadastral)
                                <option value="{{$cadastral->id}}">{{$cadastral->nome}}</option>
                            @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group col-md-4">
                <label class="font-weight-bold">Data Admissão</label>
                <input type="date" name="iniciado_em" class="form-control" id="iniciado_em">
            </div>
            <!-- <div class="form-group col-md-4">
                <label class="font-weight-bold" for="">Órgão</label>
                <div id="cp2" class="input-group" title="Using input value">

                </div>
            </div> -->
        </div>
        </div>
    </div>
   
    <br>
    
    <div class="card shadow bg-light">
        <div class="card-body">
        <small>dados de acesso</small>
            <hr>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label class="font-weight-bold" for=""> Perfil de acesso </label>
                    <div id="cp2" class="input-group" title="Using input value">
                        <select name="id_perfil" id="id_perfil" class="form-control col-md-4" required="required">
                            <option  value="-1">Não vinculado</option>
                            @foreach($perfis as $perfil)
                                <option value="{{$perfil->id}}">{{$perfil->nome}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group col-md-12">
                    <label class="font-weight-bold" for=""> E-mail principal </label>
                    <div id="cp2" class="input-group" title="Using input value">
                        <input type="email" name="email" class="form-control input-lg col-md-4" id="email" required="required"/>
                    </div>
                </div>
                <div class="form-group col-md-12">
                    <label class="font-weight-bold">Confirme o e-mail</label>
                    <input type="text" name="email_confirmacao" class="form-control col-md-4" id="email_confirmacao" required="required">
                </div>
                <div class="form-group col-md-12">
                    <label class="font-weight-bold" for=""> Senha </label>
                    <div id="cp2" class="input-group" title="Using input value">
                        <input type="password" name="senha" class="form-control input-lg col-md-3" id="senha" required="required"/>
                    </div>
                </div>
                <div class="form-group col-md-12">
                    <label class="font-weight-bold">Confirme a Senha</label>
                    <input type="password" name="senha_confirmacao" class="form-control col-md-3" id="senha_confirmacao" required="required">
                </div>

            </div>
        </div>
    </div>
   <br>
    <button type="submit" class="btn btn-success btn-lg"><i class="fas fa-save"></i> Salvar</button>
</form>
