import { createDirectus, rest, } from '@directus/sdk';
import type { Schema } from '../../types/directus';

const directus = createDirectus<Schema>(import.meta.env.PUBLIC_DIRECTUS_URL).with(rest());

export default directus;
