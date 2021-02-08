


 <div class="col-sm-12 col-md-10">
     <div class="col-sm-12 col-md-12 divalumno">
         <strong>ALUMNO:</strong> <?php echo $nombreAlumno; ?> <br/><strong>CURSO:</strong> <?php echo $salidaCurso; ?><br/>
         <strong>TUTOR:</strong> <?php echo $nombreProfesor; ?><br/>
         <strong>TUTORÍAS:</strong> <?php echo $horarioTutoria; ?><br/>
         <?php if($_SESSION["tipo"]=="padre"):?>
            <a href=" https://colegioatenea.es/zona-padres/zona-padres-2/formulario/">
                <button style="background-color: #6a3f48; border-color: #6a3f48; margin-top: 10px;" type="button" class="btn btn-info">Deseo contactar con el tutor &nbsp <span class="vc_icon_element-icon flaticon-paper-plane" style="color:#fff !important"></span></button>
            </a>
        <?php endif; ?>
     </div>
</div>   
			        