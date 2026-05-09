import './bootstrap';
import Alpine from 'alpinejs';

import { 
  roleManager, 
  employeeManager, 
  promotionManager, 
  eventManager, 
  courseTypeManager, 
  moduleManager, 
  studentManager, 
  studentProjectManager,
  generalTestimonialManager
} from './components.js';

window.Alpine = Alpine;

Alpine.data('roleManager', roleManager);
Alpine.data('employeeManager', employeeManager);
Alpine.data('promotionManager', promotionManager);
Alpine.data('eventManager', eventManager);
Alpine.data('generalTestimonialManager', generalTestimonialManager);
Alpine.data('courseTypeManager', courseTypeManager);
Alpine.data('moduleManager', moduleManager);
Alpine.data('studentManager', studentManager);
Alpine.data('studentProjectManager', studentProjectManager);

Alpine.start();