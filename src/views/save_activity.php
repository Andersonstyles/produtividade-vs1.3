<main class="content">
    <?php
        renderTitle(
            'Cadastro de Produtividade',
            'Lance e atualize sua produtividade',
            'icofont-architecture-alt'
        );

        include(TEMPLATE_PATH . "/messages.php");
    ?>

    <form action="#" method="post">
        <?php if($id): ?>
        <input type="hidden" name="id" value="<?= $id ?>">
        <?php endif ?>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="protocol">Protocolo</label>
                <input type="text"  oninput="this.value = this.value.replace(/[^0-9./]/g, '').replace(/(\..*?)\..*/g, '$1')"
                id="protocol" name="protocol" placeholder="Informe o número do protocolo"
                class="form-control <?= $errors['protocol'] ? 'is-invalid' : '' ?>"
                value="<?= $protocol ?>">
                <div class="invalid-feedback">
                    <?= $errors['protocol'] ?>
                </div>
            </div>
            <div class="form-group col-md-6">
                <label for="applicant">Requerente</label>
                <input type="text" id="applicant" name="applicant" placeholder="Informe o requerente"
                class="form-control <?= $errors['applicant'] ? 'is-invalid' : '' ?>"
                value="<?= $applicant ?>">
                <div class="invalid-feedback">
                    <?= $errors['applicant'] ?>
                </div>
            </div>
        </div>

        <div class="form-row">
        <div class="form-group col-md-6">
		
					<select id ="type" name="type"  class="form-control mr-2" placeholder="Selecione o tipo do processo">
						<option value="">Selecione o tipo do processo</option>
						<?php
							foreach($lawsuit as $process) {
								$selected = $process->id === $selectedProcessId ? 'selected' : '';
								echo "<option value='{$process->type}' {$selected}>{$process->type}</option>";
							}
						?>
					</select>
                        </div>
                <div class="form-group col-md-6">        
				<select id="punctuation" name="punctuation" class="form-control" placeholder="Selecione a pontuação">
                <option value="">Selecione a pontuação</option>
                    <?php
						foreach($lawsuit as $process) {
                            $selected = $process->id === $selectedProcessId ? 'selected' : '';
                            echo "<option value='{$process->punctuation}' {$selected}>{$process->punctuation}</option>";
                        }
					?>
				</select>
				
			</div>
                    </div>
                    </div>
                    

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="supervisor">Fiscal Responsável</label>
                <input type="text" id="supervisor" name="supervisor" placeholder="<?= $_SESSION['user']->name ?>"
                    class="form-control <?= $errors['supervisor'] ? 'is-invalid' : '' ?>" value="<?= $_SESSION['user']->name ?>">
                <div class="invalid-feedback">
                    <?= $errors['supervisor'] ?>
                </div>
            </div>
            
            
            <div class="form-group col-md-6">
                <label for="date">Data</label>
                <input type="date" id="date" name="date"
                class="form-control <?= $errors['date'] ? 'is-invalid' : '' ?>"
                value="<?= $date ?>">
                <div class="invalid-feedback">
                    <?= $errors['date'] ?>
                </div>
            </div>
        </div>
        
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="tax_code">Código do Usuário</label>
                <input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1')" 
                id="tax_code" name="tax_code" placeholder="<?= $_SESSION['user']->id ?>"
                    class="form-control <?= $errors['tax_code'] ? 'is-invalid' : '' ?>" value="<?= $_SESSION['user']->id ?>">
                <div class="invalid-feedback">
                    <?= $errors['tax_code'] ?>
                </div>
            </div>
            </div>
        <div>
            <button class="btn btn-primary btn-lg">Salvar</button>
            <a href="/activity.php"
                class="btn btn-secondary btn-lg">Cancelar</a>
        </div>
    </form>
</main>