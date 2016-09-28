import { MedicamentShow } from './controllers/medicament-show'

export function router () {
    return [
        {
            prefix: 'management',
            actions: {
                'medicament.show': MedicamentShow
            }
        }
    ];
}
