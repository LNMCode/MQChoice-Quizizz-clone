import 'dart:async';
import 'dart:ffi';

import 'package:flutter_bloc/flutter_bloc.dart';
import 'package:flutter/material.dart';
import 'package:http/http.dart' as http;
import 'package:mobileapplication/responsitory/stream_socket.dart';
import 'package:mobileapplication/screens/entercode/blocs/entercode/entercode_bloc.dart';

import 'package:mobileapplication/screens/entercode/entercode_screen.dart';
import 'package:mobileapplication/screens/roomques/blocs/question/question_bloc.dart';
import 'package:mobileapplication/screens/roomques/roomques_screen.dart';

import 'package:mobileapplication/screens/roomques/blocs/getroom/getroom_bloc.dart';
import 'package:mobileapplication/screens/roomques/blocs/getroom/getroom_bloc_observer.dart';

import 'package:mobileapplication/responsitory/repository.dart';
import 'package:mobileapplication/screens/summary/blocs/summary_bloc.dart';
import 'package:mobileapplication/screens/summary/summary_screen.dart';
import 'package:mobileapplication/screens/waitroom/blocs/waitroom_bloc.dart';
import 'package:mobileapplication/screens/waitroom_finish/blocs/waitroom_finish_bloc.dart';
import 'package:mobileapplication/screens/waitroom_finish/waitroom_finish_screen.dart';

void main() {
  Bloc.observer = GetRoomBlocObserver();
  final Repository repository = Repository(http.Client());
  final StreamSocket streamSocket = StreamSocket();
  final SocketRepository socket = SocketRepository(streamSocket: streamSocket);

  runApp(
    MultiBlocProvider(
      providers: [
        BlocProvider<EnterCodeBloc>(
          create: (context) => EnterCodeBloc(
            repository: repository,
          ),
        ),
        BlocProvider<GetRoomBloc>(
          create: (context) => GetRoomBloc(repository),
        ),
        BlocProvider<WaitRoomBloc>(
          create: (context) => WaitRoomBloc(streamSocket, socket, repository),
        ),
        BlocProvider<QuestionBloc>(
          create: (context) =>
              QuestionBloc(repository: repository, socketRepository: socket),
        ),
        BlocProvider<WaitRoomFinishBloc>(
          create: (context) => WaitRoomFinishBloc(socket, repository),
        ),
        BlocProvider<SummaryBloc>(
          create: (context) => SummaryBloc(repository),
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

  const MyApp({
    Key? key,
    required this.repository,
  }) : super(key: key);

  @override
  Widget build(BuildContext context) {
    print('Main');
    return MaterialApp(
      title: 'Material app',
      home: BlocProvider(
          create: (context) => GetRoomBloc(repository),
          child: const EnterCodeScreen()),
    );
  }
}
