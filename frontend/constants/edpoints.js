export const AUTH_ME = 'api/auth/me';
export const AUTH_LOGIN = 'api/auth/login';
export const AUTH_REGISTER = 'api/auth/register';
export const LATEX_POST = 'api/latex';

export const LATEX_GET = 'api/latex';

export const ASSIGN_POST = 'api/latex/assign';

export const GENERATE_POST = 'api/user/generate';

export const ASSIGN_GET = 'api/latex/assign'

export const STUDENT_GET = 'api/user/student'

export const IMAGE_POST = 'api/teacher/upload'

export const CSV_POST = 'api/user/csv'

export const TUTORIAL_GET_PUT = 'api/tutorial'

export const PROBLEM_BY_USER_GET = function (id) {
  return `api/user/${id}/problems`
}

export const GET_USER_BY_ID = function (id){ return `api/user/${id}`;}

export const PROBLEM_BY_ID_GET = function (id) {
  return `api/problems/${id}`;
}




