import {Observable} from './services/observable';
import {Service} from './services/service'
import {MyService} from './MyService'

var service = new MyService();
service.on('updates')
    .then(data => data * data)
    .then(data => console.log(data));

service.on('eh.test')
    .then(data => console.log(data));

service.on('eh.medicament.*')
    .then(data => console.log('Medicament changed', data));

new Vue(<any>{
    el: () => 'body'
});
