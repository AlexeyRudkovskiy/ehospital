import { MedicamentShow } from './controllers/medicament-show'
import { ContractorShow } from './controllers/contractor-show'

export function router () {
    return [
        {
            prefix: 'management',
            actions: {
                'medicament.show': MedicamentShow,
                'contractor.show': ContractorShow
            }
        }
    ];
}
