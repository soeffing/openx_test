# # Add RVM's lib directory to the load path.
# $:.unshift(File.expand_path('./lib', ENV['rvm_path']))
#  
# # Load RVM's capistrano plugin.
# require "rvm/capistrano"
# require 'bundler/capistrano'
# require 'railsless-deploy'
# 
# set :rvm_ruby_string, 'ruby-1.9.2-p320@adooza'
# set :rvm_type, :user  # Don't use system-wide RVM


  set :application, 'Ad Delivery Engine'
   set :repository,  '.'
  #set :deploy_via, :copy
  set :scm, 'git'
  set :branch, "master"
  set :git_enable_submodules, 1
  
  # Or: `accurev`, `bzr`, `cvs`, `darcs`, `git`, `mercurial`, `perforce`, `subversion` or `none`
  
  role :web, "test-dev.adooza.com", :primary => true                     # Your HTTP server, Apache/etc
  role :app, "test-dev.adooza.com"                         # This may be the same as your `Web` server
  role :db,  "test-dev.adooza.com", :primary => true # This is where Rails migrations will run
  # role :db,  "your slave db-server here"
  
  
  # server details
  default_run_options[:pty] = true
  ssh_options[:forward_agent] = true
  ssh_options[:keys] = ["/home/soeffing/Dropbox/Adooza/EC2/AdoozaSite.pem"] 
  ssh_options[:config] = false 
  #ssh_options[:verbose] = :debug 
  set :deploy_to, "/var/www"
  #set :scm_verbose, true
  # set :scm_username, "soeffing"  # If you access your source repository with a different user name than you are logged into your local machine with, Capistrano needs to know.
  set :user, "ubuntu"   # is the user on the server that runs this recipes
  set :use_sudo, true


# call like this cap deploy:testing

# namespace :testing do
# 
  # # call like this cap testing deploy
# 
  # task :test_run do
    # run "sudo mkdir tmp"
  # end
# 
  # task :upload_all do
    # run "sudo mkdir tmp"
    # run "sudo chmod -R 777 tmp"
      # # ajs.php
      # top.upload("/var/www/openx/www/delivery/ajs.php", "tmp/ajs.php")
      # run "sudo cp tmp/ajs.php /var/www/test/test-adserver/www/delivery/ajs.php"   
      # # al.php
      # top.upload("/var/www/openx/www/delivery/al.php", "tmp/al.php")
      # run "sudo cp tmp/al.php /var/www/test/test-adserver/www/delivery/al.php"
      # # layer delivered
      # top.upload("/var/www/openx/plugins/invocationTags/oxInvocationTags/layerstyles/simple/layerstyle.inc.php", "tmp/layerstyle.inc.php")
      # run "sudo cp tmp/layerstyle.inc.php /var/www/test/test-adserver/plugins/invocationTags/oxInvocationTags/layerstyles/simple/layerstyle.inc.php"
      # # Combi Ad delivered
      # top.upload("/var/www/openx/plugins/invocationTags/oxInvocationTags/layerstyles/combi/layerstyle.inc.php", "tmp/layerstyle.inc.php")
      # run "sudo cp tmp/layerstyle.inc.php /var/www/test/test-adserver/plugins/invocationTags/oxInvocationTags/layerstyles/combi/layerstyle.inc.php"
      # # Altered pop for CombiAd
      # top.upload("/var/www/openx/www/delivery/apu.php", "tmp/apu.php")
      # run "sudo cp tmp/apu.php /var/www/test/test-adserver/www/delivery/apu.php"
    # run "sudo rm -rf tmp"    
  # end
# 
  # task :upload_ajs do
  	# # upload/SFTP cannot be used with sudo ->http://osdir.com/ml/lang.ruby.capistrano.general/2008-01/msg00107.html
#     
    # # here comes the monkey patch - workaround...yipieh
    # run "sudo mkdir tmp"
    # run "sudo chmod -R 777 tmp"
    # top.upload("/var/www/openx/www/delivery/ajs.php", "tmp/ajs.php")
    # run "sudo cp tmp/ajs.php /var/www/test/test-adserver/www/delivery/ajs.php"
    # run "sudo rm -rf tmp"
  # end
# 
  # task :upload_al do
  	# # upload/SFTP cannot be used with sudo ->http://osdir.com/ml/lang.ruby.capistrano.general/2008-01/msg00107.html
#     
    # # here comes the monkey patch - workaround...yipieh
    # run "sudo mkdir tmp"
    # run "sudo chmod -R 777 tmp"
    # top.upload("/var/www/openx/www/delivery/al.php", "tmp/al.php")
    # run "sudo cp tmp/al.php /var/www/test/test-adserver/www/delivery/al.php"
    # run "sudo rm -rf tmp"
  # end
# 
    # task :upload_layer do
  	# # upload/SFTP cannot be used with sudo ->http://osdir.com/ml/lang.ruby.capistrano.general/2008-01/msg00107.html
#     
    # # here comes the monkey patch - workaround...yipieh
    # run "sudo mkdir tmp"
    # run "sudo chmod -R 777 tmp"
    # top.upload("/var/www/openx/plugins/invocationTags/oxInvocationTags/layerstyles/simple/layerstyle.inc.php", "tmp/layerstyle.inc.php")
    # run "sudo cp tmp/layerstyle.inc.php /var/www/test/test-adserver/plugins/invocationTags/oxInvocationTags/layerstyles/simple/layerstyle.inc.php"
    # run "sudo rm -rf tmp"
  # end
# 
   # task :upload_combi do
    # # upload/SFTP cannot be used with sudo ->http://osdir.com/ml/lang.ruby.capistrano.general/2008-01/msg00107.html
#     
    # # here comes the monkey patch - workaround...yipieh
    # run "sudo mkdir tmp"
    # run "sudo chmod -R 777 tmp"
    # top.upload("/var/www/openx/plugins/invocationTags/oxInvocationTags/layerstyles/combi/layerstyle.inc.php", "tmp/layerstyle.inc.php")
    # run "sudo cp tmp/layerstyle.inc.php /var/www/test/test-adserver/plugins/invocationTags/oxInvocationTags/layerstyles/combi/layerstyle.inc.php"
    # run "sudo rm -rf tmp"
  # end
# 
   # task :upload_apu do
    # # upload/SFTP cannot be used with sudo ->http://osdir.com/ml/lang.ruby.capistrano.general/2008-01/msg00107.html
#     
    # # here comes the monkey patch - workaround...yipieh
    # run "sudo mkdir tmp"
    # run "sudo chmod -R 777 tmp"
    # top.upload("/var/www/openx/www/delivery/apu.php", "tmp/apu.php")
    # run "sudo cp tmp/apu.php /var/www/test/test-adserver/www/delivery/apu.php"
    # run "sudo rm -rf tmp"
  # end
# 
# 
  # task :prepare do
    # run "sudo mkdir tmp"
    # run "sudo chmod -R 777 tmp"
  # end
# 
# 
# end


# namespace :production do
# 
  # # call like this cap testing deploy
# 
  # task :upload_all do
    # run "sudo mkdir tmp"
    # run "sudo chmod -R 777 tmp"
      # # ajs.php
      # top.upload("/var/www/openx/www/delivery/ajs.php", "tmp/ajs.php")
      # run "sudo cp tmp/ajs.php /var/www/adserver/www/delivery/ajs.php"   
      # # al.php
      # top.upload("/var/www/openx/www/delivery/al.php", "tmp/al.php")
      # run "sudo cp tmp/al.php /var/www/adserver/www/delivery/al.php"
      # # layer delivered
      # top.upload("/var/www/openx/plugins/invocationTags/oxInvocationTags/layerstyles/simple/layerstyle.inc.php", "tmp/layerstyle.inc.php")
      # run "sudo cp tmp/layerstyle.inc.php /var/www/adserver/plugins/invocationTags/oxInvocationTags/layerstyles/simple/layerstyle.inc.php"
      # # Combi Ad delivered
      # top.upload("/var/www/openx/plugins/invocationTags/oxInvocationTags/layerstyles/combi/layerstyle.inc.php", "tmp/layerstyle.inc.php")
      # run "sudo cp tmp/layerstyle.inc.php /var/www/adserver/plugins/invocationTags/oxInvocationTags/layerstyles/combi/layerstyle.inc.php"
      # # Altered pop for CombiAd
      # top.upload("/var/www/openx/www/delivery/apu.php", "tmp/apu.php")
      # run "sudo cp tmp/apu.php /var/www/adserver/www/delivery/apu.php"
    # run "sudo rm -rf tmp"      end
# 
  # task :upload_ajs do
    # # upload/SFTP cannot be used with sudo ->http://osdir.com/ml/lang.ruby.capistrano.general/2008-01/msg00107.html
#     
    # # here comes the monkey patch - workaround...yipieh
    # run "sudo mkdir tmp"
    # run "sudo chmod -R 777 tmp"
    # top.upload("/var/www/openx/www/delivery/ajs.php", "tmp/ajs.php")
    # run "sudo cp tmp/ajs.php /var/www/adserver/www/delivery/ajs.php"
    # run "sudo rm -rf tmp"
  # end
# 
  # task :upload_al do
    # # upload/SFTP cannot be used with sudo ->http://osdir.com/ml/lang.ruby.capistrano.general/2008-01/msg00107.html
#     
    # # here comes the monkey patch - workaround...yipieh
    # run "sudo mkdir tmp"
    # run "sudo chmod -R 777 tmp"
    # top.upload("/var/www/openx/www/delivery/al.php", "tmp/al.php")
    # run "sudo cp tmp/al.php /var/www/adserver/www/delivery/al.php"
    # run "sudo rm -rf tmp"
  # end
# 
    # task :upload_layer do
    # # upload/SFTP cannot be used with sudo ->http://osdir.com/ml/lang.ruby.capistrano.general/2008-01/msg00107.html
#     
    # # here comes the monkey patch - workaround...yipieh
    # run "sudo mkdir tmp"
    # run "sudo chmod -R 777 tmp"
    # top.upload("/var/www/openx/plugins/invocationTags/oxInvocationTags/layerstyles/simple/layerstyle.inc.php", "tmp/layerstyle.inc.php")
    # run "sudo cp tmp/layerstyle.inc.php /var/www/adserver/plugins/invocationTags/oxInvocationTags/layerstyles/simple/layerstyle.inc.php"
    # run "sudo rm -rf tmp"
  # end
# 
   # task :upload_combi do
    # # upload/SFTP cannot be used with sudo ->http://osdir.com/ml/lang.ruby.capistrano.general/2008-01/msg00107.html
#     
    # # here comes the monkey patch - workaround...yipieh
    # run "sudo mkdir tmp"
    # run "sudo chmod -R 777 tmp"
    # top.upload("/var/www/openx/plugins/invocationTags/oxInvocationTags/layerstyles/combi/layerstyle.inc.php", "tmp/layerstyle.inc.php")
    # run "sudo cp tmp/layerstyle.inc.php /var/www/adserver/plugins/invocationTags/oxInvocationTags/layerstyles/combi/layerstyle.inc.php"
    # run "sudo rm -rf tmp"
  # end
# 
  # task :upload_apu do
    # # upload/SFTP cannot be used with sudo ->http://osdir.com/ml/lang.ruby.capistrano.general/2008-01/msg00107.html
#     
    # # here comes the monkey patch - workaround...yipieh
    # run "sudo mkdir tmp"
    # run "sudo chmod -R 777 tmp"
    # top.upload("/var/www/openx/www/delivery/apu.php", "tmp/apu.php")
    # run "sudo cp tmp/apu.php /var/www/adserver/www/delivery/apu.php"
    # run "sudo rm -rf tmp"
  # end
# 
  # task :prepare do
    # run "sudo mkdir tmp"
    # run "sudo chmod -R 777 tmp"
  # end
# 
# 
# end



#task :migrate do
    # do nothing
# end

# if you're still using the script/reaper helper you will need
# these http://github.com/rails/irs_process_scripts

# If you are using Passenger mod_rails uncomment this:
# namespace :deploy do
#   task :start do ; end
#   task :stop do ; end
#   task :restart, :roles => :app, :except => { :no_release => true } do
#     run "#{try_sudo} touch #{File.join(current_path,'tmp','restart.txt')}"
#   end
# end