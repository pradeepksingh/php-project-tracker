
			<div id="content">
			
				<h1><?=$project->project_name?> - new release</h1>
                
                <p><b>New Release</b> - Use this page to add the lastest release to your project. This page is not for creating
                new projects. If you try to add a release for a project that doesn't exist, you will receive a slap on the wrist!
                Use the form below to commit details to the database for your release. Once you have done so,
                the release will appear as the latest release for the selected project.</p>
                
                <h2>New Release Form</h2>
                
                <fieldset style="margin-top: 30px;">
                	<legend>Release Form</legend>
                        
                        <?php if ( strlen ( validation_errors() ) > 0 ) : ?>
                        <div id="errors">
                                <ul>
                                        <?=validation_errors()?>
                                </ul>
                        </div>
                        <?php endif; ?>
                        <?php if ( isset ( $file_error ) ) : ?>
                        <div id="errors">
                            <p><?=$file_error?></p>
                        </div>
                        <?php endif; ?>
                     
                     <p>Please remember that this form is for adding a <b>new release</b> to an <b>existing project</b>.</p>
                     
                     <form enctype="multipart/form-data" action="<?=current_url()?>" method="post" style="padding-left: 50px">
                                          
                     	<table width="100%">
                        
                        	<tr>
                            	<td colspan="2"><h2 class="bl">Details...</h2></td>
                            </tr>
                        	<tr>
                            	<td>Project Name:</td> <td><input name="project_name" type="text" readonly="readonly" value="<?=$project->project_name?>" /></td>
                            </tr>
                            <tr>
                            	<td>Project Author:</td> <td><input name="project_author" type="text" readonly="readonly" value="<?=$this->session->userdata('username')?>" /></td>
                            </tr>
                            <tr>
                            	<td>Project Stage</td>
                                <td>
                                        <select name="project_stage" style="width: 22em; padding: 5px; border: 1px solid black;">
                                                <option value="Just a thought..">Just a thought..</option>
                                                <option value="In Design">In Design</option>
                                                <option value="Alpha">Alpha</option>
                                                <option value="Beta">Beta</option>
                                                <option value="Stable">Stable</option>
                                        </select>
                                        </td>
                            </tr>
                            <tr>
							<td>Project Version:</td>
							<td><input type="text" name="project_version" value="<?=set_value('project_version')?>" /></td>
                            </tr>
                            <tr>
                                <td colspan="2"><h2 class="bl">Files</h2></td>
                            </tr>
                            <tr>
                                <td>Project File</td>
                                <td class="file"><input type="file" name="file" /></td>
                            </tr>
                            <tr>
                                <td colspan="2" align=""><input type="submit" name="submit_release" value="Add Release" /></td>
                            </tr>
                        </table>
                     
                     </form>
                
                </fieldset>
                
                <h2>Project Info</h2>
                
                <ul>
                    <li>
                        <?php if ( @$project_info->project_version !== NULL ) : ?>
                        Current project version: <code><?=$project_info->project_version?></code>
                        <?php else : ?>
                        No releases have been made.
                        <?php endif; ?>
                    </li>
                </ul>
                 
                        
                        <div class="push">

                                </div>
                        
			</div>      
            