import os
import sys

sys.path.append('/var/www/wsgi/')

os.environ['PYTHON_EGG_CACHE'] = '/var/www/wsgi/.python-egg'
os.environ['DJANGO_SETTINGS_MODULE'] = 'mysite.settings'

import django.core.handlers.wsgi
application = django.core.handlers.wsgi.WSGIHandler()
