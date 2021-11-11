import 'package:flutter_bloc/flutter_bloc.dart';
import 'package:flutter/material.dart';
import 'package:http/http.dart' as http;
import 'package:mobileapplication/screens/entercode/blocs/entercode/entercode_bloc.dart';

import 'package:mobileapplication/screens/entercode/entercode_screen.dart';
import 'package:mobileapplication/screens/roomques/roomques_screen.dart';

import 'package:mobileapplication/screens/roomques/blocs/getroom/getroom_bloc.dart';
import 'package:mobileapplication/screens/roomques/blocs/getroom/getroom_bloc_observer.dart';

import 'package:mobileapplication/responsitory/repository.dart';

void main() {
  Bloc.observer = GetRoomBlocObserver();
  final Repository repository = Repository(http.Client());

  runApp(
    MultiBlocProvider(
      providers: [
        BlocProvider<EnterCodeBloc>(
          create: (context) => EnterCodeBloc(repository: repository),
        ),
      ],
      child: MyApp(
        repository: repository,
      ),
    ),
  );
}

class MyApp extends StatelessWidget {
  final Repository repository;
  const MyApp({Key? key, required this.repository})
      : assert(repository != null),
        super(key: key);

  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      title: 'Material app',
      home: BlocProvider(
        create: (context) => GetRoomBloc(repository),
        child: EnterCodeScreen(),
      ),
    );
  }
}
