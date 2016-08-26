# filter_bath_https_monitor
Filter Embed and iFrames to see if they are not https and give warning to user.

[![Build Status](https://travis-ci.org/hitteshahuja/filter_bath_https_monitor.svg?branch=master)](https://travis-ci.org/hitteshahuja/filter_bath_https_monitor)

**Install the plugin**
Under your Moodle installation, under filters folder : 
1. git clone https://github.com/hitteshahuja/filter_bath_https_monitor.git
 
 OR 
 2. Download zip from github
 
 Extract the files under the filter/ folder of your moodle installation
 
Go to Site Administration > Notifications and install the plugin

**Configure**

Once installed successfully,you can configure the plugin under Site Administration > Plugins >  Filters >  HTTPS Monitor > Settings
 
 1.**Text message to replace with** : 
 Use this option to give your own custom message to be used throughout the site
 2. **Message type**: Follows bootstrap label css options listed here: http://getbootstrap.com/components/#labels
 3. **Position**: Display message before or after the embed/ iframe  